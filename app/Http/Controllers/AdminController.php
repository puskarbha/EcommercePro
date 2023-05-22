<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class AdminController extends Controller
{
  public function view_category()
  {
      if(Auth::id() && (Auth::user()->usertype==1)){
          $data=category::all();
          return view('admin.category',compact('data'));
      }
      else{
          return redirect('login');
      }

  }

    public function add_category(Request $request)
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $data= new category;
            $data->category_name=$request->category;
            $data->save();
            return redirect()->back()->with('message','category added successfully');
        }
        else{
            return redirect('login');
        }

    }

    public function delete_category($id)
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $data = category::find($id);
            $data->delete();
            return redirect()->back()->with('message','category deleted successfully');
        }
        else{
            return redirect('login');
        }

    }


    public function view_product()
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $category=category::all();
            return view('admin.product',compact('category'));
        }
        else{
            return redirect('login');
        }

    }
    public function add_product(Request $request)
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $data= new product;
            $data->title=$request->title;
            $data->description=$request->description;
            $data->price=$request->price;
            $data->quantity=$request->quantity;
            $data->discount_price=$request->dis_price;
            $data->category=$request->category;
            //for Image
            $image=$request->image;
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imageName);
            $data->image=$imageName;

            $data->save();
            return redirect()->back()->with('message','Product added successfully');
        }
        else{
            return redirect('login');
        }

    }

    public function show_product()
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $products=Product::all();
            return view('admin.show_product',compact('products'));
        }
        else{
            return redirect('login');
        }

    }

    public function delete_product($id)
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
        $product = product::find($id);
        $product->delete();
        return redirect()->back()->with('message','product deleted successfully');
    }
    else{
        return redirect('login');
    }

    }
    public function update_product($id)
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $product=product::find($id);
            $category=category::all();
            return view('admin.update_product',compact('product','category'));
        }
        else{
            return redirect('login');
        }

    }

    public function update_product_confirm(Request $request,$id)
    {
        if(Auth::id() && (Auth::user()->usertype==1)){
            $product = Product::findOrFail($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->dis_price;
            $product->category = $request->category;
            $product->quantity = $request->quantity;
            $image = $request->image;
            if($image)
            {

                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('product', $imageName);
                $product->image = $imageName;
            }

            $product->save();
            return redirect()->back()->with('message','Product Updated successfully');
        }
        else{
            return redirect('login');
        }


    }
    public function order(){
        if(Auth::id() && (Auth::user()->usertype==1)){
            $orders=Order::all();
            return view('admin.order',compact('orders'));
        }
        else{
            return redirect('login');
        }

    }
public function delivered($id){
    if(Auth::id() && (Auth::user()->usertype==1)){
        $order=order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status="paid";
        $order->save();
        return redirect()->back();
    }
    else{
        return redirect('login');
    }

}
public function print_pdf($id){
    if(Auth::id() && (Auth::user()->usertype==1)){
        $order=Order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));

        return $pdf->download('order_details.pdf');
    }
    else{
        return redirect('login');
    }


}

public function searchData(Request $request){
    if(Auth::id() && (Auth::user()->usertype==1)){
        $searchText=$request->search;
        $orders=Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
        return view('admin.order',compact('orders'));
    }
    else{
        return redirect('login');
    }

}
}
