<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('user')->paginate(10);

         return view('cms.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $admins = Admin::with('user')->get();

         return view('cms.admin.create', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email'       => 'required|email|unique:admins,email',
        'password'    => 'required|min:6',
        'first_name'  => 'required|string|max:45',
        'last_name'   => 'required|string|max:45',
        'phone'       => 'required|string|unique:users,phone|max:45',
        'birth_month' => 'nullable|string',
        'birth_day'   => 'nullable|integer|min:1|max:31',
        'status'      => 'required|in:active,inactive',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    // 1. Create the admin
    $admin = Admin::create([
        'email'    => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // 2. Create the user and morph it to the admin
    if($admin){
    $users=new User();
    $users->first_name=$request->input('first_name');
    $users->last_name=$request->input('last_name');
    $users->phone=$request->input('phone');
    $users->birth_month=$request->input('birth_month');
    $users->birth_day=$request->input('birth_day');
    $users->status=$request->input('status');
    $users->actor()->associate($admin);
    $isSaved=$users->save();

    }


    // User::create([
    //     'first_name'  => $request->first_name,
    //     'last_name'   => $request->last_name,
    //     'phone'       => $request->phone,
    //     'birth_month' => $request->birth_month,
    //     'birth_day'   => $request->birth_day,
    //     'status'      => $request->status,
    //     'actor_type'  => Admin::class, // morph type
    //     'actor_id'    => $admin->id,   // morph id
    // ]);
     return response()->json([
        'icon'  => 'success',
        'title' => 'Admin created successfully',

    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $admin = Admin::with('user')->findOrFail($id);
        return view('cms.admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::with('user')->findOrFail($id);
        return view('cms.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'email'       => 'required|email|unique:admins,email,' . $id,
        'password'    => 'nullable|min:6',
        'first_name'  => 'required|string|max:45',
        'last_name'   => 'required|string|max:45',
        'phone'       => 'required|string|max:45|unique:users,phone,' . $admin->user->id,
        'birth_month' => 'nullable|string',
        'birth_day'   => 'nullable|integer|min:1|max:31',
        'status'      => 'required|in:active,inactive',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    // Update admin account
    $admin->email = $request->email;
    if ($request->filled('password')) {
        $admin->password = bcrypt($request->password);
    }
    $admin->save();

    // Update related user
    $admin->user->update([
        'first_name'  => $request->first_name,
        'last_name'   => $request->last_name,
        'phone'       => $request->phone,
        'birth_month' => $request->birth_month,
        'birth_day'   => $request->birth_day,
        'status'      => $request->status,
    ]);

    return response()->json([
        'icon'     => 'success',
        'title'    => 'Admin updated successfully',
        'redirect' => route('cms.admins.index'),
    ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin=Admin::destroy($id);
    }

    public function trashed()
    {
       $admins = Admin::onlyTrashed()
                   ->with(['user' => function($query) {
                       $query->withTrashed();
                   }])
                   ->orderBy('deleted_at', 'desc')
                   ->get();

    return view('cms.admin.trashed', compact('admins'));
    }

    public function restore($id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        $admin->restore();
        $admin->user()->withTrashed()->restore();

        return back()->with('success', 'Admin restored successfully');
    }

    public function force($id)
    {
        Admin::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Admin deleted permanently');
    }

    public function forceAll()
    {
        Admin::onlyTrashed()->forceDelete();
        return back()->with('success', 'All trashed admins deleted permanently');
    }
}
