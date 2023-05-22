<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Product list Page</title>
    <style>
        .center
        {
            margin:auto;
            width:50%;
            border: solid green 2px;
            text-align: center;
            margin-top: 40px;
        }
        .font_size
        {
            text-align: center;
            font-size: 40px;

        }
        .img_size
        {
            width:150px;
            height:150px;
        }
        .th_color
        {
            background: skyblue;
        }
        th{
            padding: 30px;
        }
        /* Additional styles for responsiveness */
        @media (max-width: 600px) {

            th,
            td {
                display: block;
                width: 100%;
            }
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
                <h2 class="font_size">All Products</h2>
                <table class="center">
                   <tr class="th_color">
                       <th>Product title</th>
                       <th>Description</th>
                       <th>Quantity</th>
                       <th>Category</th>
                       <th>Price</th>
                       <th>Discount Price</th>
                        <th>Product Image</th>
                       <th>Delete</th>
                       <th>Edit</th>
                   </tr>
                    @foreach($products as $product)
                    <tr style="border: white solid 1px">
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$product->image}}" alt="Image Not found">
                        </td>
                        <td>
                            <a href="{{url('delete_product',$product->id)}}" class="btn btn-danger"  onclick="return confirm('Are you sure to delete this?')">Delete</a>
                        </td>
                        <td>
                            <a href="{{url('update_product',$product->id)}}" class="btn btn-success">Edit</a>
                        </td>
                    </tr>

                    @endforeach
                </table>
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
