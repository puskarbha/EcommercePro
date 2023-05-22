<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
        }

        .center {
            text-align: center;
            margin: auto;
            max-width: 100%;
            margin-top: 40px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;

        }

        .img_size {
            width: 100px;
            height: 100px;
        }

        /* Additional styles for responsiveness */
        @media (max-width: 600px) {

            th,
            td {
                display: block;
                width: 100%;
            }
        }
        th{
            background-color: #64a5e6;
        }
    </style>
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
                <h1 class="title_deg">All Orders</h1>
                <div style="text-align: center;padding-top: 30px">
                    <form action="{{url('search')}}" method="get">
                        @csrf
                        <input style="color: black" type="text" name="search" placeholder="Search for something">
                        <input type="submit" value="search" class="btn btn-outline-primary">
                    </form>
                </div>
                <div class="center">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product_title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment status</th>
                            <th>Delivery Status</th>
                            <th>Image</th>
                            <th>Delivered</th>
                            <th>Print PDF</th>
                        </tr>
                        @forelse($orders as $order)
                            <tr style="border: white solid 1px">
                                <td>{{$order->name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->product_title}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->delivery_status}}</td>
                                <td><img class="img_size" src="/product/{{$order->image}}" alt=""></td>
                                <td> @if($order->delivery_status=='processing')
                                    <a href="{{url('delivered',$order->id)}}" class="btn btn-primary"
                                       onclick="return confirm('Are you sure this product is delivered?')">Delivered</a>
                                         @else
                                        <P style="color:Green">DELIVERED</P>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">PDF</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16"><div><p>No data found !!</p></div></td>
                            </tr>

                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin.script')
</body>

</html>
