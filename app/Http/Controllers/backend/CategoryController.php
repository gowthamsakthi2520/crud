<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('backend.category.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.category.addcategory');
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
            'category_name' => 'required',
            'category_slug' => 'required',
            'category_description' => 'required',

        ]);

        try {

            
            Categories::create($validate);
            $msg = "Category Added Succesfully";
            return response()->json(['status' => true, 'success' => $msg], 200);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

    }
    //category table show
    public function category_lists()
    {
        try {
            return view('backend.category.view');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function dataTables(Request $request)
    {

        try {

            $category = Categories::select('*');
            $categorycount = Categories::select('*');

            if (isset($request->searchdata) && $request->searchdata != '') {
                $category->where('category_name', 'like', '%' . $request->searchdata . '%')->orWhere('category_slug', 'like', '%' . $request->searchdata . '%')->orWhere('category', 'like', '%' . $request->searchdata . '%')->orWhere('date', 'like', '%' . $request->searchdata . '%');
                $categorycount->where('category_name', 'like', '%' . $request->searchdata . '%')->orWhere('category_slug', 'like', '%' . $request->searchdata . '%')->orWhere('category', 'like', '%' . $request->searchdata . '%')->orWhere('date', 'like', '%' . $request->searchdata . '%');
            }

            $totalcount = $categorycount->get();
            $totalcount = count($totalcount);

            $allemp = $category->orderBy('id', 'desc')->take($request->length)->skip($request->start)->get();

            $arr = array();
            $i = $request->start + 1;
            foreach ($allemp as $val) {

                $var['id'] = $val->id;
                $var['category_name'] = (isset($val->category_name)) ? $val->category_name : '';
                $var['category_slug'] = (isset($val->category_slug)) ? $val->category_slug : '';
                $var['category_description'] = (isset($val->category_description)) ? $val->category_description : '';
                $var['status'] = (isset($val->status)) ? $val->status : '';


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

            $category = Categories::where('id', $id)->first();
            return view('backend.category.edit', compact('category'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required',
            'category_description' => 'required',

        ]);
        // dd($validate);
        try {

            $category = Categories::where('id', $id)->first();
            $category->update($validate);
            $success = "Category Updated Successfully";
            return response()->json(['status' => true, 'success' => $success], 200);
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
            $Categories = Categories::where('id', $id)->first();
            $Categories->delete();
            $msg = "Category Has Been Deleted Successfully";
            return response()->json(['status' => true, 'msg' => $msg], 200);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
