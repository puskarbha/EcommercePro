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
        .heading{
            text-align: center;
            text-decoration: black;
            font-size: 25px;
            padding: 20px;
            font-family: "Copperplate Gothic Bold", sans-serif;
        }
        table,th,td{
            border: 1px solid grey;
        }
        .total,th{
            font-size: 15px;
            padding: 15px;
            background: skyblue;
        }
        .img_deg {
            width: 200px;
            height: 200px;
        }
        .cancel_button{
            font-size: 20px;
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
    <table class="center">
        <h1 class="heading">My Orders</h1>
        <tr>
            <th>Product Title</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Delivery Status</th>
            <th>Image</th>
            <th>Cancel Order</th>

        </tr>
        <?php $totalPrice=0; ?>
        @foreach($orders as $order)
        <tr>
           <td>{{$order->product_title}}</td>
           <td>{{$order->quantity}}</td>
           <td>{{$order->price}}</td>
           <td>{{$order->payment_status}}</td>
           <td>{{$order->delivery_status}}</td>
            <td><img class="img_deg" src="/product/{{$order->image}}" alt="Image not found"></td>

            <td >
                @if($order->delivery_status=='processing')
                <a href="{{url('cancel_order',$order->id)}}" class="btn-danger cancel_button" onclick="return confirm('Are you sure to cancel the order?')">Cancel</a>
                @else
                   <p>Not allowed</p>
                @endif
            </td>
        </tr>
                <?php $totalPrice+=$order->price; ?>
        @endforeach
        <tr class="total">
            <td>Total</td>
            <td colspan="6">रु.{{$totalPrice}}</td>
        </tr>

    </table>
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
