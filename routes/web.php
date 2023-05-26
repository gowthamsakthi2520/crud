<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/products',(App\Http\Controllers\backend\ProductController::class));
Route::resource('/category',(App\Http\Controllers\backend\CategoryController::class));
Route::get('/product_lists',[App\Http\Controllers\backend\ProductController::class,'product_lists'])->name('product_list');
Route::get('/product_table/{id}',[App\Http\Controllers\backend\ProductController::class,'product_view_table'])->name('product_table');

//category table -> url ..category_list
Route::get('/category_list',[App\Http\Controllers\backend\CategoryController::class,'category_lists'])->name('category_list');
// category table details
Route::get('/category_datatable',[App\Http\Controllers\backend\CategoryController::class,'dataTables'])->name('category_datatable');