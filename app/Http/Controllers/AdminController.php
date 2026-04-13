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
    User::create([
        'first_name'  => $request->first_name,
        'last_name'   => $request->last_name,
        'phone'       => $request->phone,
        'birth_month' => $request->birth_month,
        'birth_day'   => $request->birth_day,
        'status'      => $request->status,
        'actor_type'  => Admin::class, // morph type
        'actor_id'    => $admin->id,   // morph id
    ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
