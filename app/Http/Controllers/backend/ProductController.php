<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $category = Categories::where('status', 'active')->get();
            // dd($category);
            return view('backend.products.addproduct', compact('category'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // dataTables view 
        try {
            return view('backend.products.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

    }

    public function product_view_table(string $id)
    { //  get the product id view
        try {
            $product = Products::where('id', $id)->first();
            // dd($product);
            return view('backend.products.view', compact('product'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

    }

    public function product_lists(Request $request)
    {

        try {

            $category = Products::select('*');
            $categorycount = Products::select('*');

            if (isset($request->searchdata) && $request->searchdata != '') {
                $category->where('name', 'like', '%' . $request->searchdata . '%')->orWhere('price', 'like', '%' . $request->searchdata . '%')->orWhere('category', 'like', '%' . $request->searchdata . '%')->orWhere('date', 'like', '%' . $request->searchdata . '%');
                $categorycount->where('name', 'like', '%' . $request->searchdata . '%')->orWhere('price', 'like', '%' . $request->searchdata . '%')->orWhere('category', 'like', '%' . $request->searchdata . '%')->orWhere('date', 'like', '%' . $request->searchdata . '%');
            }

            $totalcount = $categorycount->get();
            $totalcount = count($totalcount);

            $allemp = $category->orderBy('id', 'desc')->take($request->length)->skip($request->start)->get();

            $arr = array();
            $i = $request->start + 1;
            $c = [];
            foreach ($allemp as $val) {
                //image view variables
                $url = url('/');
                $img = explode(',', $val->product_images);
                $product_img = $url . '/' . $img[0];

                $c = explode(',',$val->category_name->category_name);

                $var['id'] = $val->id;
                $var['product_name'] = (isset($val->product_name)) ? $val->product_name : '';
                $var['product_img'] = $product_img;
                $var['sale_price'] = (isset($val->sale_price)) ? $val->sale_price : '';
                $var['category'] = $c;
                $var['stock'] = (isset($val->stock)) ? $val->stock : '';
                $var['date'] = (isset($val->created_at)) ? $val->created_at->todatestring() : '';

                $var['index'] = $i++;
                array_push($arr, $var);
            }

            $data['draw'] = $request->draw;
            $data['recordsTotal'] = $totalcount;
            $data['recordsFiltered'] = $totalcount;
            $data['data'] = $arr;

            return json_encode($data);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'product_name' => 'required',
            'stock' => 'required',
            'product_images' => 'required',
            'category' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'product_description' => 'required',

        ]);

        try {

            $Files = [];
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $file) {
                    $name = time() . rand(1, 50) . '.' . $file->extension();
                    $file->move(public_path('product_images'), $name);
                    $Files[] = 'product_images/' . $name;
                }
            }
            $validate['product_images'] = implode(',', $Files);
            //category array to string
            $validate['category'] = implode(',', $request->category);

            Products::create($validate);
            $msg = "Product Added Successfully";
            return back()->with(['msg' => $msg]);
        } catch (\Exception $e) {

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $product = Products::where('id', $id)->first();
            $category = Categories::where('status', 'active')->get();

            return view('backend.products.edit', compact('product', 'category'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->product_images);
        $validate = $request->validate([
            'product_name' => 'required',
            'stock' => 'required',
            'category' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'product_description' => 'required',
        ]);
        try {

            $product = Products::where('id', $id)->first();

            if ($request->product_images != "") {

                $Files = [];
                if ($request->hasFile('product_images')) {
                    foreach ($request->file('product_images') as $file) {
                        $name = time() . rand(1, 50) . '.' . $file->extension();
                        $file->move(public_path('product_images'), $name);
                        $Files[] = 'product_images/' . $name;
                    }
                }
            }
            //product_images input field array to string conversion
            $validate['product_images']=implode(',',$Files); 
            //category input field array to string conversion
            $validate['category'] = implode(',', $request->category);
            $product->update($validate);
            $msg = "Product has been Updated Successfully";
            return response()->json(['status' => true, 'success' => $msg], 200);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Products::where('id', $id)->first();
            $product->delete();
            $msg = "Product Has Been Deleted Successfully";
            return response()->json(['status' => true, 'msg' => $msg], 200);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}