<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['customer', 'cartItems.product'])->orderBy('id', 'desc')->paginate(5);
        return view('cms.cart.index', compact('carts'));
    }

    public function create()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('cms.cart.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_status' => 'required|in:active,ordered,cancelled',
            'customers_id' => 'required|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        $cart = new Cart();
        $cart->cart_status = $request->input('cart_status');
        $cart->customers_id = $request->input('customers_id');
        $cart->save();

        return response()->json([
            'icon' => 'success',
            'title' => 'Cart created successfully',
            'redirect' => route('cms.carts.index'),
        ], 200);
    }

    public function show($id)
    {
        $cart = Cart::with(['customer', 'cartItems'])->findOrFail($id);
        return view('cms.cart.show', compact('cart'));
    }

    public function edit($id)
    {
        $cart = Cart::findOrFail($id);
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('cms.cart.edit', compact('cart', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cart_status' => 'required|in:active,ordered,cancelled',
            'customers_id' => 'required|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        $cart = Cart::findOrFail($id);
        $cart->cart_status = $request->input('cart_status');
        $cart->customers_id = $request->input('customers_id');
        $cart->save();

        return response()->json([
            'icon' => 'success',
            'title' => 'Cart updated successfully',
            'redirect' => route('cms.carts.index'),
        ], 200);
    }

    public function destroy($id)
    {
        Cart::destroy($id);

        return response()->json([
            'icon' => 'success',
            'title' => 'Cart deleted successfully',
        ], 200);
    }

    public function trashed()
    {
        $carts = Cart::with('customer')->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('cms.cart.trashed', compact('carts'));
    }

    public function restore($id)
    {
        Cart::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Cart restored successfully');
    }

    public function force($id)
    {
        Cart::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Cart deleted permanently');
    }

    public function forceAll()
    {
        Cart::onlyTrashed()->forceDelete();
        return back()->with('success', 'All trashed carts deleted permanently');
    }
}
