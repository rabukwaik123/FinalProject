<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function indexProduct($id)
    {
        $products = Product::where('admin_id' , $id)->with(['category', 'brand' , 'admin'])->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.product.index', compact('products' , 'id'));
    }

    public function createProduct($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $admins = Admin::all();
        return response()->view('cms.product.create', compact('categories', 'brands' ,'admins', 'id'));
    }
    public function index()
    {
        $products = Product::with(['category', 'brand'])->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.product.indexAll', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return response()->view('cms.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:100',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'admin_id' => 'required|exists:admins,id',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
        else{
            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_description = $request->input('product_description');
            $product->price = $request->input('price');
            $product->category_id = $request->input('category_id');
            $product->brand_id = $request->input('brand_id');
            $product->admin_id = $request->input('admin_id');
            $product->is_active = $request->boolean('is_active');

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time().'image.'.$image->getClientOriginalExtension();
                $image->move(public_path('cms/dist/img/product/'), $imageName);
                $product->image_path = 'cms/dist/img/product/' . $imageName;
            }
            $product->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Created Product is Successfully',
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Product::with(['category', 'brand' ,'admin'])->findOrFail($id);
        return view('cms.product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        $admins = Admin::all();
        return response()->view('cms.product.edit', compact('products', 'categories', 'brands' , 'admins' ,'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:100',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'admin_id' => 'required|exists:admins,id',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
        else{
            $product = Product::findOrFail($id);
                $product->product_name = $request->input('product_name');
                $product->product_description = $request->input('product_description');
                $product->price = $request->input('price');
                $product->category_id = $request->input('category_id');
                $product->brand_id = $request->input('brand_id');
                $product->admin_id = $request->input('admin_id');
                $product->is_active = $request->boolean('is_active');

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time().'image.'.$image->getClientOriginalExtension();
                $image->move(public_path('cms/dist/img/product/'), $imageName);
                $product->image_path = 'cms/dist/img/product/' . $imageName;
            }

                $product->save();

                return response()->json([
                'icon' => 'success',
                'title' => 'Updated is successfully',
                'redirect' => route('cms.products.index'),
            ], 200);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $products = Product::destroy($id);
    }
}
