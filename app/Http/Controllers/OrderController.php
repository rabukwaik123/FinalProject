<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $orders = Order::with('customer')->orderBy('id', 'desc')->paginate(10);
         $totalAmount = Order::sum('total_amount');
        return response()->view('cms.order.index', compact('orders','totalAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
         $products = Product::all();
        return response()->view('cms.order.create', compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    //  Decode items
    $items = json_decode($request->items, true);

    //  Validation
    $validator = Validator::make([
        'order_status' => $request->order_status,
        'customer_id' => $request->customer_id,
        'items' => $items,
    ], [
        'order_status' => 'required|in:pending,completed,cancelled',
        'customer_id' => 'required|exists:customers,id',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
    ],[
       // 'items.required'=>'it has to be array'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }


    $order = Order::create([
        'order_status' => $request->order_status,
        'customer_id' => $request->customer_id,
        'total_amount' => 0.0
    ]);

    $total = 0;


    foreach ($items as $item) {

        $product = Product::find($item['product_id']);

        if (!$product) continue;

        $price = $product->price;
        $quantity = $item['quantity'];

        $orderItems=new OrderItem();
        $orderItems->order_id = $order->id;
        $orderItems->product_id = $product->id;
        $orderItems->quantity = $quantity ;
        $orderItems->total_price = $price ;


        $total += $price * $quantity;
        $issaved = $orderItems->save();

    }


    $order->update([
        'total_amount' => $total
    ]);


    return response()->json([
        'icon' => 'success',
        'title' => 'Order created successfully',
        'redirect' => route('cms.orders.index'),
    ], 200);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with([
        'customer',
        'items.product'
    ])->findOrFail($id);

    return view('cms.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();

        return response()->view('cms.order.edit', compact('order', 'customers','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      //  Decode items
    $items = json_decode($request->items, true);

    // Validation
    $validator = Validator::make([
        'order_status' => $request->order_status,
        'customer_id' => $request->customer_id,
        'items' => $items,
    ], [
        'order_status' => 'required|in:pending,completed,cancelled',
        'customer_id' => 'required|exists:customers,id',
        'items' => 'nullable|array',
        'items.*.product_id' => 'sometimes|required|exists:products,id',
        'items.*.quantity' => 'sometimes|required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'icon' => 'error',
            'title' => $validator->getMessageBag()->first(),
        ], 400);
    }

    // Find order
    $order = Order::findOrFail($id);

    // Update basic fields
    $order->order_status = $request->order_status;
    $order->customer_id = $request->customer_id;
    $order->total_amount = 0;
    $order->save();

    // delete old items
    OrderItem::where('order_id', $order->id)->delete();

    $total = 0;

    //  Insert new items
    foreach ($items as $item) {

        $product = Product::find($item['product_id']);
        if (!$product) continue;

        $price = $product->price;
        $quantity = $item['quantity'];
        $orderItems=new OrderItem();
        $orderItems->order_id=$order->id;
        $orderItems->product_id=$product->id;
        $orderItems->quantity=$quantity;
        $orderItems->total_price=$quantity*$price;

        $isupdated = $orderItems->save();
        $total += $price * $quantity;
    }

    // Update total
    $order->update([
        'total_amount' => $total
    ]);
    return['redirect'=>route('cms.orders.index')];
    }
     public function destroy($id)
    {
        $orders=Order::destroy($id);
    }
     public function trashed()

    {
        $orders = Order::with('customer')->orderBy('id', 'desc')->onlyTrashed()->get();
         $totalAmount = Order::sum('total_amount');
        return response()->view('cms.order.trashed', compact('orders','totalAmount'));
    }

    public function restore($id)
    {
        Order::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Order restored successfully');
    }

    public function force($id)
    {
        Order::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Order deleted permanently');
    }

    public function forceAll()
    {
        Order::onlyTrashed()->forceDelete();
        return back()->with('success', 'All trashed orders deleted permanently');
    }
}
