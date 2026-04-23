<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Product;
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
        $products = Product::all();
        return view('cms.cart.create', compact('customers','products'));
    }

    public function store(Request $request)
    {
         // Decode items
    $items = json_decode($request->items, true);

    // Validation
    $validator = Validator::make([
        'cart_status' => $request->cart_status,
        'customer_id' => $request->customer_id,
        'items'       => $items,
    ], [
        'cart_status'          => 'required|in:active,checked_out,abandoned',
        'customer_id'          => 'required|unique|exists:customers,id',
        'items'                => 'required|array|min:1',
        'items.*.product_id'   => 'required|exists:products,id',
        'items.*.quantity'     => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    // Create the cart
    $cart = Cart::create([
        'cart_status'  => $request->cart_status,
        'customer_id'  => $request->customer_id, // matches your DB column name
    ]);

    // Create cart items
    foreach ($items as $item) {
        $product = Product::find($item['product_id']);
        if (!$product) continue;

        $cartItem = new CartItem();
        $cartItem->cart_id    = $cart->id;
        $cartItem->product_id = $product->id;
        $cartItem->quantity    = $item['quantity'];
        $cartItem->total_price = $product->price * $item['quantity'];
        $cartItem->save();
    }

    return response()->json([
        'icon'  => 'success',
        'title' => 'Cart created successfully',
    ]);
    }

    public function edit($id)
    {
        $cart = Cart::findOrFail($id);
        $products = Product::all();
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('cms.cart.edit', compact('cart', 'customers','products'));
    }

    public function update(Request $request, $id)
    {
       // Decode items
    $items = json_decode($request->items, true);

    $validator = Validator::make([
        'cart_status'  => $request->cart_status,
        'customer_id' => $request->customer_id,
        'items'        => $items,
    ], [
        'cart_status'          => 'required|in:active,ordered,cancelled',
        'customer_id'         => 'required|exists:customers,id',
        'items'                => 'nullable|array',
        'items.*.product_id'   => 'required|exists:products,id',
        'items.*.quantity'     => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon'  => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    // Update the cart
    $cart = Cart::findOrFail($id);
    $cart->cart_status  = $request->cart_status;
    $cart->customer_id  = $request->customer_id;
    $cart->save();

    // Delete old items and re-insert fresh ones
    $cart->cartItems()->delete();

    foreach ($items as $item) {
        $product = Product::find($item['product_id']);
        if (!$product) continue;

        $cartItem = new CartItem();
        $cartItem->cart_id    = $cart->id;
        $cartItem->product_id = $product->id;
        $cartItem->quantity    = $item['quantity'];
        $cartItem->total_price = $product->price * $item['quantity'];
        $cartItem->save();
    }

    return response()->json([
        'icon'     => 'success',
        'title'    => 'Cart updated successfully',
        'redirect' => route('cms.carts.index'),
    ], 200);
}
    public function show($id)
{
    $cart = Cart::withTrashed()->with([
        'customer',
        'cartItems.product'
    ])->findOrFail($id);

    return view('cms.cart.show', compact('cart'));
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
