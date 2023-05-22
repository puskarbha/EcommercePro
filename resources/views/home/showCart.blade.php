<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <style>
        .center{
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
        }
        table,th,td{
            border: 1px solid grey;
        }
        .total,th{
            font-size: 15px;
            padding: 5px;
            background: skyblue;
        }
        .img_deg{
            width: 200px;
            height:200px
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
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
        </div>
    @endif
    <table class="center">
        <?php $totalPrice=0; ?>
        <tr>
            <th>Product title</th>
            <th>Product Quantity</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach($carts as $cart)
        <tr>
            <td>{{$cart->product_title}}</td>
            <td>{{$cart->quantity}}</td>
            <td>रु.{{$cart->price}}</td>
            <td><img class="img_deg" src="/product/{{$cart->image}}" alt="image not found"></td>
            <td>
                <a href="{{url('remove_cart',$cart->id)}}" class="btn-danger" onclick="return confirm('Are you sure to remove this product?')">Remove</a>
                <a href="" class="btn-success">Edit</a>
            </td>
        </tr>
            <?php $totalPrice+=$cart->price; ?>
        @endforeach
    <tr class="total">
        <td>Total</td>
        <td colspan="4">रु.{{$totalPrice}}</td>
    </tr>
    </table>
    <div class="center">
        <h1 style="font-size: 25px;" >Proceed to Order</h1>
        <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
        <a href="{{url('stripe',$totalPrice)}}" class="btn btn-danger">Pay using card</a>
    </div>
</div>
</div>
<!-- footer start -->
@include('home.footer')
<!-- footer end -->
<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

    </p>
</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper jhome/s -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrahome/p js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom jhome/s -->
<script src="home/js/custom.js"></script>
</body>
</html>
