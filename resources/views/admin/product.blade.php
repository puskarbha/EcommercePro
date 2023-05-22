<!DOCTYPE html>
<html lang="en">
<head>

    <style type="text/css">
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

              <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                  @csrf
              <div class="div_center">
                  <h1 class="font_size">Add Product</h1>
                  <div class="div_design">
                      <label for="title">Product title :</label>
                      <input type="text" name="title" class="text_color" id="title" placeholder="Write a title" required>
                  </div>

                  <div class="div_design">
                      <label for="description">Product description :</label>
                      <input type="text" name="description" class="text_color" id="description" placeholder="Write a description" required>
                  </div>

                  <div class="div_design">
                      <label for="price">Product Price :</label>
                      <input type="number" name="price" class="text_color" id="price" placeholder="Write a price" required>
                  </div>

                  <div class="div_design">
                      <label for="discount">Discount price :</label>
                      <input type="number" name="dis_price"  class="text_color" id="discount" placeholder="Write a discont price">
                  </div>

                  <div class="div_design">
                      <label for="quantity">Product Quantity :</label>
                      <input type="number" name="quantity" min="0" class="text_color" id="title" placeholder="Write a Product Quantity"  required>
                  </div>

                  <div class="div_design">
                      <label for="category">Product Category :</label>
                      <select name="category" id="category" class="text_color"  required>
                          <option value="" selected>Add a Category Here</option>
                          @foreach($category as $item)
                              <option value="{{$item->category_name}}">{{$item->category_name}}</option>
                          @endforeach
                          <option value="Shirt">Shirt</option>
                          <option value="pant">Pant</option>
                      </select>
                  </div>

                  <div class="div_design">
                      <label for="image">Product Image :</label>
                      <input type="file" name="image" id="image" alt=""  required>
                  </div>

                  <div class="div_design">
                      <input type="submit" name="submit" class="btn btn-primary" value="Add Productt">
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
