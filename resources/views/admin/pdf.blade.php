<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
</head>
<body>
 <h1>Order Details</h1>
 Customer Name:<h3>{{$order->name}}</h3>
 Customer email: <h3>{{$order->email}}</h3>
 Customer phone:  <h3>{{$order->phone}}</h3>
 Customer address: <h3>{{$order->address}}</h3>
 Customer id: <h3>{{$order->user_id}}</h3>
 Product title: <h3>{{$order->product_title}}</h3>
 Product price: <h3>{{$order->price}}</h3>
 Product quantity:  <h3>{{$order->quantity}}</h3>
 Payment status: <h3>{{$order->payment_status}}</h3>
 Product  id: <h3>{{$order->product_id}}</h3>
 <?php
     $imagePath = "product/" . $order->image;
     $imageData = base64_encode(file_get_contents($imagePath));
     $base64Image = "data:image/png;base64," . $imageData;
 ?>
 <img src="{{$base64Image}}" alt="">
</body>
</html>
