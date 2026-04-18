<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(5);
        return view('cms.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('cms.customer.create');
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'email'       => 'required|email|unique:customers,email',
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

    // 1. Create the customer
    $customer = Customer::create([
        'email'    => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // 2. Create the user and morph it to the customer
    $user=new User();
    $user->first_name=$request->input('first_name');
    $user->last_name=$request->input('last_name');
    $user->phone=$request->input('phone');
    $user->birth_month=$request->input('birth_month');
    $user->birth_day=$request->input('birth_day');
    $user->status=$request->input('status');
    $user->actor()->associate($customer);
    $isSaved=$user->save();
    // User::create([
    //     'first_name'  => $request->first_name,
    //     'last_name'   => $request->last_name,
    //     'phone'       => $request->phone,
    //     'birth_month' => $request->birth_month,
    //     'birth_day'   => $request->birth_day,
    //     'status'      => $request->status,
    //     'actor_type'  => Customer::class, // morph type
    //     'actor_id'    => $customer->id,   // morph id
    // ]);

    return response()->json([
        'icon'  => 'success',
        'title' => 'Customer created successfully',

    ]);
    }

    public function show($id)
    {
        $customer = Customer::with('user')->findOrFail($id);
        return view('cms.customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::with('user')->findOrFail($id);
        return view('cms.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'email'       => 'required|email|unique:admins,email,' . $id,
        'password'    => 'nullable|min:6',
        'first_name'  => 'required|string|max:45',
        'last_name'   => 'required|string|max:45',
        'phone'       => 'required|string|max:45|unique:users,phone,' . $customer->user->id,
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
    $customer->email = $request->email;
    if ($request->filled('password')) {
        $customer->password = bcrypt($request->password);
    }
    $customer->save();

    // Update related user
    $customer->user->update([
        'first_name'  => $request->first_name,
        'last_name'   => $request->last_name,
        'phone'       => $request->phone,
        'birth_month' => $request->birth_month,
        'birth_day'   => $request->birth_day,
        'status'      => $request->status,
    ]);

    return response()->json([
        'icon'     => 'success',
        'title'    => 'Customer updated successfully',
        'redirect' => route('cms.customers.index'),
    ], 200);
    }

    public function destroy($id)
    {
        Customer::destroy($id);

        return response()->json([
            'icon' => 'success',
            'title' => 'Customer deleted successfully',
        ], 200);
    }

    public function trashed()
    {
        $customers = Customer::onlyTrashed()
                   ->with(['user' => function($query) {
                       $query->withTrashed(); // ⚠️ l
                   }])
                   ->orderBy('deleted_at', 'desc')
                   ->get();

    return view('cms.customer.trashed', compact('customers'));
    }

    public function restore($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->restore();
        $customer->user()->withTrashed()->restore();

        return back()->with('success', 'Customer restored successfully');
    }

    public function force($id)
    {
        Customer::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Customer deleted permanently');
    }

    public function forceAll()
    {
       $customers = Customer::onlyTrashed()->with('user')->get();
        foreach ($customers as $customer) {
        $customer->forceDelete();
    }
        return back()->with('success', 'All trashed customers deleted permanently');
    }
}
