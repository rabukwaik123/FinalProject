<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use Dotenv\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all();
        $categories = Category::withcount('products')->orderBy('id','desc')->paginate(perPage: 3);
        return view('cms.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(),[
            'category_name' => 'required|string|max:50|unique:categories,category_name',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
        if($validator->fails()){
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }
        else {
            $categories = new Category();
            $categories->category_name = $request->input('category_name');

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time().'image.'.$image->getClientOriginalExtension();
                $image->move(public_path('cms/dist/img/category'), $imageName);
                $categories->image_path = 'cms/dist/img/category' . $imageName;
            }

            $issaved = $categories->save();
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
        $categories = Category::findOrFail(id: $id);
        return response()->view('cms.category.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(),[
            'category_name' => 'required|string|max:50|unique:categories,category_name,' . $id,
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
        if($validator->fails()){
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }
        else {
            $categories =Category::findOrFail($id);
            $categories->category_name = $request->input('category_name');
            // $categories->image_path = $request->input('image_path');

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time().'image.'.$image->getClientOriginalExtension();
                $image->move(public_path('cms/dist/img/category'), $imageName);
                $categories->image_path = 'cms/dist/img/category' . $imageName;
            }

            $isupdated = $categories->save();

            // return['redirect'=>route('cms.categories.index')];
            return response()->json([
                'icon' => 'success',
                'title' => 'Updated is successfully',
                'redirect' => route('cms.categories.index'),
            ], 200);
    }}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categories = Category::destroy($id);
    }


    public function trashed(){
        $categories = Category::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return response()->view('cms.category.trashed', compact('categories'));
    }

    public function restore($id){
        $categories = Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('sucess','Success');
    }

    public function force($id){
        $categories = Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('sucess','Success');
    }

    public function forceAll(){
        $categories = Category::onlyTrashed()->forceDelete();
        return back()->with('sucess','Success');
    }
}
