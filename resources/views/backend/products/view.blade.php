<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD</title>
    <link rel="stylesheet" href="{{ asset('css/frontend/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Toast css link -->
	<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <link rel="stylesheet" href="{{ asset('css/frontend/icons.css') }}">
     <style>
        .table {
  width: 60vw;
  display: flex;
  flex-wrap: wrap;
  row-gap: 20px;
}

.term {
  width: 20%;
  display: flex;
  align-items: center;
  padding: 8px 8px;
  background-color: #4B7CB6;
  color: white;
  position: relative;
}

.term::after {
  content: "";
  width: 12px;
  height: 24px;
  position: absolute;
  background-color: #4B7CB6;
  left: 100%;
  clip-path: polygon(0% 0%, 100% 50%, 0% 100%)
}

.desc {
  width: 80%;
  background-color: #eee;
  display: flex;
  align-items: center;
  padding: 8px 8px 8px 24px;
}

/* ******************************* */
body {
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}



* {
  box-sizing: border-box;
  margin: 0;
}

     </style>
</head>

<body>

<dl class="table">
  <dt class="term">Product Name</dt>
  <dd class="desc">{{isset($product)?$product -> product_name : ''}}</dd>
  <dt class="term">Stock</dt>
  <dd class="desc">{{isset($product)?$product->stock : ''}}</dd>
  <dt class="term">Product Image</dt>
  <dd class="desc">
    @foreach(explode(',',$product->product_images) as $img)
    <img src="{{asset($img)}}" width="200" alt="Image">
    @endforeach
  </dd>
  <dt class="term">Category</dt>
  <dd class="desc">{{isset($product)? $product->category : ''}}</dd>
  <dt class="term">Regular Price</dt>
  <dd class="desc">{{isset($product) ? $product->regular_price : ''}}</dd>
  <dt class="term">Sale Price</dt>
  <dd class="desc">{{isset($product)? $product->sale_price : ''}}</dd>
  <dt class="term">Description</dt>
  <dd class="desc">{{isset($product)? $product->product_description : ''}}</dd>

</dl>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- toast link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Sweet alert link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- js link file -->
    <script src="{{ asset('js/backend/custom.js') }}"></script>
</body>

</html>
