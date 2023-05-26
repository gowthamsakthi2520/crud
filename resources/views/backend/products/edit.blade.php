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
</head>

<body>
    <div class="container w-50 border mt-5">
        <div class="title mb-4">Edit Product</div>
        <form id="edit_products" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class=" col-6 mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name"  name="product_name" value="{{isset($product)? $product->product_name : ''}}">
                    <span class="text-danger product_name"></span>
                    <!-- product id hidden -->
                    <input type="hidden" id="product_id" name="product_id"data-product_id="{{$product->id}}" value="{{$product->id}}">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label" for="stock">Stock Quantity</label>
                    <input type="text" class="form-control" id="stock" name="stock" value="{{isset($product)? $product->stock : ''}}">
                    <span class="text-danger stock"></span>
                </div>

            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label for="product_images" class="form-label">Product Image</label>
                    <input type="file" name="product_images[]" class="form-control mb-3" id="product_images" accept=".jpg, .png, image/jpeg, image/png" multiple>
                    @foreach(explode(',',$product->product_images) as $img)
                    <img src="{{asset($img)}}" width="100" alt="Images" class="mt-2">
                    @endforeach
                    <label for="product_images" class="form-label">{{$product->product_images}}</label>
                    <span class="text-danger product_images"></span>
                </div>


                <div class=" col-6 mb-3">
                    <label for="category" class="form-label">Product Category</label>
                    <select name="category[]" id="category" class="form-select" multiple>
                     @foreach($category as $value)
                     <option value="{{$value->id}}" {{$product->category == $value->id ? 'selected' : ''}}>{{$value->category_name}}</option>
                     @endforeach
                    </select>
                    <span class="text-danger category"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label" for="regular_price">Regular Price</label>
                    <input type="number" class="form-control" id="regular_price" name="regular_price" value="{{isset($product)? $product->regular_price : ''}}">
                    <span class="text-danger regular_price"></span>
                </div>
                <div class="col-6 mb-3">
                    <label for="UrunImage" class="form-label">Sale Price</label>
                    <input type="number" class="form-control" name="sale_price" id="sale_price" value="{{isset($product)? $product->sale_price : ''}}">
                    <span class="text-danger sale_price"></span>
                </div>
            </div>
            <div class="col-12 mb-3">
                <label for="product_description" class="form-label">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="3">{{isset($product)? $product->product_description : ''}}</textarea>
                <span class="text-danger product_description"></span>
            </div>
            <div class="button">
                <input type="submit" value="Re-Publish">
            </div>
        </form>

    </div>
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
