
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products </span>
            </h2>
            <div>
                <form action="{{url('searchProduct')}}" method="get">
                    <input style="width: 500px;" type="text" name="search" placeholder="Search for something">
                    <input type="submit" value="Search" class="btn btn-inline-primary">
                </form>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
        @endif

        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{url('product_details',$product->id)}}" class="option1">
                                   Product Details
                                </a>
                                <form action="{{url('add_cart',$product->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3" style="margin-top: 5px">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" style="width:75px ;height:30px">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" value="Add To Cart" style="margin-top: 24px;">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="/product/{{$product->image}}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{$product->title}}
                            </h5>
                            @if($product->discount_price!=null AND $product->discount_price!=0 )
                                <h6 style="color:red;">
                                    Discount price: रु.{{$product->discount_price}}
                                </h6>
                                <h6 style="text-decoration: line-through;color: blue">
                                    Price: रु.{{$product->price}}
                                </h6>

                            @else
                                <h6 style="color:blue;">
                                    Price: रु.{{$product->price}}
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="row" style="padding-top: 20px">
            {{ $products->links() }}
             <form action="{{ $products->url($products->currentPage()) }}" method="GET" style="display: inline-block; margin-left: 10px;">

                 <label for="page">
                     <input type="number" min="1" name="page" placeholder="Jump To " style="width: 100px;height:20px;">
                 </label>
                 <button type="submit">Go</button>
            </form>
        </div>
        <span>Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
</div>
</section>
