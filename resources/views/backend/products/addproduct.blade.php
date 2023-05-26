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
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
                <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>
                <div class="list-group rounded-0">
                    <a href="#"
                        class="list-group-item list-group-item-action active border-0 d-flex align-items-center">
                        <span class="bi bi-border-all"></span>
                        <span class="ml-2">Dashboard</span>
                    </a>
                    <a href="{{route('products.index')}}"
                        class="list-group-item list-group-item-action border-0 align-items-center">
                        <span class="bi bi-box"></span>
                        <span class="ml-2">Products</span>
                    </a>

                    <button
                        class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#sale-collapse">
                        <div>
                            <span class="bi bi-cart-dash"></span>
                            <span class="ml-2">Sales</span>
                        </div>
                        <span class="bi bi-chevron-down small"></span>
                    </button>
                    <div class="collapse" id="sale-collapse" data-parent="#sidebar">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Customers</a>
                            <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Sale Orders</a>
                        </div>
                    </div>

                    <button
                        class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#purchase-collapse">
                        <div>
                            <span class="bi bi-cart-plus"></span>
                            <span class="ml-2">Purchase</span>
                        </div>
                        <span class="bi bi-chevron-down small"></span>
                    </button>
                    <div class="collapse" id="purchase-collapse" data-parent="#sidebar">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Sellers</a>
                            <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Purchase Orders</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- overlay to close sidebar on small screens -->
            <div class="w-100 vh-100 position-fixed overlay d-none" id="sidebar-overlay"></div>
            <!-- note: in the layout margin auto is the key as sidebar is fixed -->
            <div class="col-md-9 col-lg-10 ml-md-auto px-0 dash-main">
                <!-- top nav -->
                <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm">
                    <!-- close sidebar -->
                    <button class="btn py-0 d-lg-none" id="open-sidebar">
                        <span class="bi bi-list text-primary h3"></span>
                    </button>
                    <div class="dropdown ml-auto">
                        <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="bi bi-person text-primary h4"></span>
                            <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm"
                            aria-labelledby="logout-dropdown">
                            <a class="dropdown-item" href="#">Logout</a>
                            <a class="dropdown-item" href="#">Settings</a>
                        </div>
                    </div>
                </nav>
                <!-- main content -->
                <main class="container-fluid">
                    <section class="row">
                        <div class="col-md-6 col-lg-4">
                            <!-- card -->
                            <article class="p-4 rounded shadow-sm border-left
               mb-4">
                                <a href="{{route('products.create')}}" class="d-flex align-items-center">
                                    <span class="bi bi-box h5"></span>
                                    <h5 class="ml-2">Products</h5>
                                </a>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <article class="p-4 rounded shadow-sm border-left mb-4">
                                <a href="#" class="d-flex align-items-center">
                                    <span class="bi bi-person h5"></span>
                                    <h5 class="ml-2">Customers</h5>
                                </a>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <article class="p-4 rounded shadow-sm border-left mb-4">
                                <a href="{{ROUTE('category_list')}}" class="d-flex align-items-center">
                                    <span class="bi bi-person-check h5"></span>
                                    <h5 class="ml-2">Category</h5>
                                </a>
                            </article>
                        </div>
                    </section>

                    <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
                        <div class="container">
                             <!-- add product form start -->
    <div class="container w-100 border mt-5">
        <div class="title mb-4">Add Product</div>
        <form id="add_products" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class=" col-6 mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name">
                    <span class="text-danger product_name"></span>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label" for="stock">Stock Quantity</label>
                    <input type="text" class="form-control" id="stock" name="stock">
                    <span class="text-danger stock"></span>
                </div>

            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label for="product_images" class="form-label">Product Image</label>
                    <input type="file" class="form-control" name="product_images[]" id="product_images" multiple>
                    <span class="text-danger product_images"></span>
                </div>


                <div class=" col-6 mb-3">
                    <label for="category" class="form-label">Product Category</label>
                    <select name="category[]" id="category" class="form-select"  multiple>
                        <!-- <option value="">Select a Category</option> -->
                        @foreach($category as $key => $value)
                        <option value="{{$value->id}}">{{$value->category_name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger category"></span>
                </div>


            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label" for="regular_price">Regular Price</label>
                    <input type="number" class="form-control" id="regular_price" name="regular_price">
                    <span class="text-danger regular_price"></span>
                </div>
                <div class="col-6 mb-3">
                    <label for="UrunImage" class="form-label">Sale Price</label>
                    <input type="number" class="form-control" name="sale_price" id="sale_price">
                    <span class="text-danger sale_price"></span>
                </div>
            </div>
            <div class="col-12 mb-3">
                <label for="product_description" class="form-label">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="3"></textarea>
                <span class="text-danger product_description"></span>
            </div>
            <div class="button">
                <input type="submit" value="Add Product">
            </div>
        </form>

    </div>


                        </div>
                    </div>
                </main>
            </div>
        </div>
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
    <!-- js link -->
    <script src="{{ asset('js/backend/category_custom.js') }}"></script>

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
