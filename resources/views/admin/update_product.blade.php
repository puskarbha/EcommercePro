<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Product page</title>
<base href="/public">
    <style >
        .div_center
        {
            text-align:center;
            padding-top:40px;
        }
        .font_size
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color
        {
            color: black;
            padding-bottom: 20px;
        }

        label
        {
            display: inline-block;
            width:200px;
        }
        .div_design
        {
            padding-bottom: 15PX;
        }
    </style>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>
                @endif

                <form action="{{url('/update_product_confirm',$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="div_center">
                        <h1 class="font_size">Edit  Product</h1>
                        <div class="div_design">
                            <label for="title">Product title :</label>
                            <input type="text" name="title" class="text_color" id="title" placeholder="Write a title" required value="{{$product->title}}">
                        </div>

                        <div class="div_design">
                            <label for="description">Product description :</label>
                            <input type="text" name="description" class="text_color" id="description" placeholder="Write a description" required  value="{{$product->description}}">
                        </div>

                        <div class="div_design">
                            <label for="price">Product Price :</label>
                            <input type="number" name="price" class="text_color" id="price" placeholder="Write a price" required value="{{$product->price}}">
                        </div>

                        <div class="div_design">
                            <label for="discount">Discount price :</label>
                            <input type="number" name="dis_price"  class="text_color" id="discount" placeholder="Write a discount price"  value="{{$product->discount_price}}">
                        </div>

                        <div class="div_design">
                            <label for="quantity">Product Quantity :</label>
                            <input type="number" name="quantity" min="0" class="text_color" id="quantity" placeholder="Write a Product Quantity"  required  value="{{$product->quantity}}">
                        </div>

                        <div class="div_design">
                            <label for="category">Product Category :</label>
                            <select name="category" id="category" class="text_color"  required>
                                <option value="{{$product->category}}" selected>{{$product->category}}</option>
                                @foreach($category as $item)
                                    <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="div_design">

                            <label for="image">Current  Product Image :</label>
                            <img style="margin: auto" height="100px" width="100px" src="/product/{{$product->image}}" alt="">
                        </div>
                        <div class="div_design">

                            <label for="image">Change Product Image :</label>
                            <input type="file" name="image" id="image" alt=""  >
                        </div>

                        <div class="div_design">
                            <input type="submit" name="submit" class="btn btn-primary" value="update Product">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin.script')
</body>
</html>
