<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::withcount('products')->orderBy('id','desc')->paginate(10);
        return view('cms.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validator = Validator($request->all(),[
            'brand_name' => 'required|string|max:45|unique:brands,brand_name,',
        ]);
        if($validator->fails()){
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }
        else {
            $brands = new Brand();
            $brands->brand_name = $request->input('brand_name');
            $issaved = $brands->save();
            }
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is successfully'
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brands = Brand::findOrFail(id: $id);
        return response()->view('cms.brand.show', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brands = Brand::findOrFail($id);
        return response()->view('cms.brand.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(),[
            'brand_name' => 'required|string|max:45|unique:brands,brand_name,' . $id,
        ]);
        if($validator->fails()){
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }
        else {
            $brands =Brand::findOrFail($id);
            $brands->brand_name = $request->input('brand_name');

            $isupdated = $brands->save();

            return['redirect'=>route('cms.brands.index')];
    }}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brands = Brand::destroy($id);
    }
}
