<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;
use App\Models\Cart;
use App\Models\order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use  RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    public function redirect(){
        $usertype=Auth::User()->usertype;

        if($usertype=='1'){ //for Admin
            $totalProducts=Product::all()->count();
            $totalOrders=Order::all()->count();
            $totalUser=User::all()->count();

//            $totalRevenue
            $orders=Order::all();
            $totalRevenue=0;
            foreach($orders as $order ){
                $totalRevenue+=$order->price;
            }

          //processing order
            $totalProcessing=Order::where('delivery_status','=','processing')->get()->count();
            //delivered Order
            $totalDelivered=Order::where('delivery_status','=','delivered')->get()->count();
            return view('admin.home',compact('totalProducts','totalOrders','totalUser','totalRevenue','totalDelivered','totalProcessing'));
        }
        else{
            $reply=Reply::all();
            $comments=Comment::orderby('id','desc')->get();
            $products=DB::table('products')->paginate(9)->withQueryString();;
            return view('home.userpage',compact('products','comments','reply'));
        }
    }

    public function index(){
        $comments=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        $products=DB::table('products')->paginate(9)->withQueryString();;
            return view('home.userpage',compact('products','comments','reply'));
    }

    public function product_details($id){
            $product=Product::find($id);
            return  view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
            {
                $user=Auth::user();
                $userid=$user->id;
                $product=Product::find($id);
                $product_exist_id=Cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

                if($product_exist_id)
                {
                    $cart=cart::find($product_exist_id)->first();
                    $quantity=$cart->quantity;
                     $totalQuantity=$request->quantity+$quantity;
                    $cart->quantity=$totalQuantity;
                    if($product->discount_price!=null AND $product->discount_price!=0 )
                    {
                        $cart->price=$totalQuantity*$product->discount_price;

                    }
                    else{
                        $cart->price=$totalQuantity*$product->price;
                    }
                    $cart->save();
                    Alert::success('Product Added Successfully','We have added product to the cart.');
                    return redirect()->back();
                }
                else
                {
                    $cart=new Cart;
                    $cart->name=$user->name;
                    $cart->email=$user->email;
                    $cart->address=$user->address;
                    $cart->phone=$user->phone;
                    $cart->product_title=$product->title;
                        if($product->discount_price!=null AND $product->discount_price!=0 )
                        {
                            $cart->price=$request->quantity*$product->discount_price;

                        }
                        else{
                            $cart->price=$request->quantity*$product->price;
                        }
                    $cart->quantity=$request->quantity;
                    $cart->image=$product->image;
                    $cart->product_id=$product->id;
                    $cart->user_id=$user->id;
                    $cart->save();
//                    can use warning or info in place of success
                    Alert::success('Product Added Successfully','We have added product to the cart.');
                    return redirect()->back();
                }

            }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart(){
        if(Auth::id()){
            $id=Auth::user()->id;
            $carts=Cart::where('user_id','=',$id)->get();
            return view('home.showCart',compact('carts'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id){
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order(){
        $id=Auth::user()->id;
        $datas=cart::where('user_id','=',$id)->get();
        foreach($datas as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','Ordered paced successfully !');
    }

    public function stripe($totalPrice){
        return view('home.stripe',compact('totalPrice'));
    }

    public function stripePost(Request $request,$totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);
        $id=Auth::user()->id;
        $datas=cart::where('user_id','=',$id)->get();
        foreach($datas as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;
            $order->payment_status='paid';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
    }
        Session::flash('success', 'Payment successful!');
        return back();
    }

    public function show_order(){

        if(Auth::id()){
            $id=Auth::user()->id;
            $orders=Order::where('user_id','=',$id)->get();
            return view('home.showOrders',compact('orders'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order=Order::find($id);
        $order->delivery_status='cancelled';
        $order->save();
        return redirect()->back();
    }
    public function searchProduct(Request $request){
        $reply=Reply::all();
        $comments=Comment::orderby('id','desc')->get();
        $searchText=$request->search;
        $products = Product::where('title', 'LIKE', "%$searchText%")
            ->orWhere('category', 'LIKE', "%$searchText%")
            ->orWhere('description', 'LIKE', "%$searchText%")
            ->paginate(9)
            ->withQueryString();
        return view('home.userpage',compact('products','comments','reply'));
    }
    public function add_comment(Request $request){
        if(Auth::id()){
           $comment=new comment;
           $comment->name=Auth::user()->name;
           $comment->comment=$request->comment;
            $comment->user_id=Auth::user()->id;
            $comment->save();
            return back();
        }
        else{
            return redirect('login');
        }
    }
    public function add_reply(Request $request){
        if(Auth::id()){
            $reply= new reply;
            $reply->name=Auth::user()->name;
            $reply->reply=$request->reply;
            $reply->comment_id=$request->commentId;
            $reply->user_id=Auth::user()->id;
            $reply->save();
            return back();
        }
        else{
            return redirect('login');
        }
    }
    public function show_products(){
        $products=DB::table('products')->paginate(9)->withQueryString();;
        return view('home.productPage',compact('products'));
    }
}
