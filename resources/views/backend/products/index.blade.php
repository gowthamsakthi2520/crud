
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <meta name="base_url" content="{{url('/')}}" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
     <link rel="stylesheet" href="{{asset('css/frontend/bootstrap-tables.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/frontend/dataTables.bootstrap5.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/frontend/icons.css')}}" >
     <link rel="stylesheet" href="{{asset('css/frontend/bootstrap.min.css.map')}}" >
     <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
     <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
      <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>
      <div class="list-group rounded-0">
        <a href="#" class="list-group-item list-group-item-action active border-0 d-flex align-items-center">
          <span class="bi bi-border-all"></span>
          <span class="ml-2">Dashboard</span>
        </a>
        <a href="{{route('products.create')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-box"></span>
          <span class="ml-2">Products</span>
        </a>

        <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#sale-collapse">
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

        <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#purchase-collapse">
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
      <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm" >
        <!-- close sidebar -->
        <button class="btn py-0 d-lg-none" id="open-sidebar">
          <span class="bi bi-list text-primary h3"></span>
        </button>
        <div class="dropdown ml-auto">
          <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown" aria-expanded="false">
            <span class="bi bi-person text-primary h4"></span>
            <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="logout-dropdown">
            <a class="dropdown-item" href="#">Logout</a>
            <a class="dropdown-item" href="#">Settings</a>
          </div>
        </div>
      </nav>
      <!-- main content -->
      <main class="container-fluid" style="margin-right:300px;">
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
              <a href="{{route('category_list')}}" class="d-flex align-items-center">
                <span class="bi bi-person-check h5"></span>
                <h5 class="ml-2">Category</h5>
              </a>
            </article>
          </div>
        </section>
        
        <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm border-left px-4">
  <div class="container">

  <!-- table start -->
  <div class="container"  style="margin-left:200px;">
  <!-- products start -->
<div class="container">
  <div class="card mt-4">
    <div class="card-body">
      <div class="product-table">
        <div class="table-responsive white-space-nowrap">
          <a href="{{route('products.index')}}" class="btn btn-primary mb-3">Add Product</a>
          <table id="productList" class="table table-bordered align-middle"  style="width:100%" >
            <thead class="table-light">
              <tr>
              <th>S.no</th>
              <th>Product Name</th>
              <th>Sale Price</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Date</th>
              <th>Action</th>
              </tr>
            </thead>
            <tbody>
                   

            </tbody>
          </table>

          </div>
        </div>
      </div>
  </div>
</div>
      </main>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


<!-- Jquery links -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script src="{{asset('js/frontend/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/frontend/dataTables.bootstrap5.min.js')}}"></script>
<!-- js link file -->
<!-- .... -->
<!-- sweet alert -->
<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
<script>
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<script>
  
$(document).ready(function() {

var reporttables =  $('#productList').DataTable({
  "order": [[ 0, "desc" ]],
      "serverSide": true,
       "stateSave": true,
      'processing': true,
      oLanguage: {sProcessing: '<div class="lds-css"><div style="width:100%;height:100%" class="lds-eclipse"><div></div><p>Please wait while we are processing your request.</p></div></div>' },
  "ajax": {
    'type': 'GET',
    'url': '{{ route("product_list") }}',
    "data": function(d){
     d.searchdata = d.search.value
    }
  },
  searching: true,
  "iDisplayLength": 10,
  "columnDefs": [
  {
    "targets": 0,
    data: 'index',
  },
  {
    "targets": 1,
    orderable: false,
    "render": function ( data, type, row, meta ) {
     
      return '<div class="d-flex align-items-center gap-3"><div class="product-box"><img src='+row.product_img+' alt="" width="100" height="100"></div><div class="product-info"><a href="" class="product-title btn">'+row.product_name+'</a><p class="mb-0 product-category">Stock : '+row.stock+'</p></div></div>';
    }
  },
  {
    "targets": 2,
    orderable: false,
    "render": function ( data, type, row, meta ) {
     return row.sale_price; 

    }
  },
  {
    "targets": 3,
    orderable: false,
    "render": function ( data, type, row, meta ) {
     return row.category;

    }
  },
  {
    "targets": 4,
    orderable: false,
    "render": function ( data, type, row, meta ) {
     return row.stock;

    }
  },
  {
    "targets": 5,
    orderable: false,
    "render": function ( data, type, row, meta ) {
     return row.date;

    }
  },
  {
    "targets": 6,
    orderable: false,
    "render": function ( data, type, row, meta ) {
      
      return '<a href="{{route('product_table','')}}'+'/'+row.id+'"><button class="btn btn-sm btn-light border" type="button"><i class="bi bi-eye-fill text-primary"></i></button></a><a href="{{url('products')}}/'+row.id+'/edit"><button class="btn btn-sm btn-light border" type="button"><i class="bi bi-pencil-square text-warning"></i></button></a><a><button class="btn btn-sm btn-light border" onclick="deleteOrder('+row.id+')"type="button"><span class="bi bi-trash text-danger"></span></button></a>';

    }
  }
  ],
  rowId: 'id'
});
});

// delete for sweet alert

function deleteOrder(id) {

swal({
  title: "Are you sure?",
  text: "Confirm to delete this Product?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel plx!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    var token = $('meta[name="csrf-token"]').attr("content");
    var formData = new FormData();
    formData.append("_token", "{{ csrf_token() }}");
    formData.append("id", id);
    $.ajax({
      url: "{{route('products.destroy','')}}"+"/"+id,
      data: formData,
      type: 'DELETE',
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (res) {
        if (res) {
          swal("Deleted!", "Your Product has been deleted.", "success");
          $('#productList').DataTable().ajax.reload();
        } else {
          swal("Product Delete Failed", "Please try again. :)", "error");
        }
      }
    });

  } else {
  swal("Cancelled", "Cancelled", "error");
  }
});
}
</script>
  
    <!-- products end -->
<!-- admin panel end -->

    
</body>
</html>

