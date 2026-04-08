@extends('cms.parent')

@section('title','Show Order')
@section('main-title','Orders')
@section('sub-title','Show')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
    --glow-pink-dark:#b46888;
    --soft-bg:#faf6f8;
    --soft-line: rgba(0,0,0,.08);
  }

  .card-shift{ margin-left:.5cm; margin-right:.5cm; }

  .icon-circle{
    width: 38px; height: 38px;
    border-radius: 999px;
    background: rgba(201,124,157,.16);
    display:flex; align-items:center; justify-content:center;
    color: var(--glow-pink-dark);
  }

  .glow-info-box{
    background: var(--soft-bg);
    border: 1px solid rgba(201,124,157,.25);
    border-radius: 12px;
    padding: 14px 16px;
  }

  .glow-row{
    padding: 10px 0;
  }

  .glow-label{
    font-weight:700;
    min-width: 150px;
  }

  .table{
    border-radius: 12px;
    overflow: hidden;
  }

</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">

    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle"><i class="fas fa-eye"></i></div>
        <h3 class="card-title mb-0">Order Details</h3>
      </div>
    </div>

    <div class="card-body">

      {{-- ORDER INFO --}}
      <div class="glow-info-box mb-4">

        <div class="glow-row">
          <span class="glow-label">Order ID:</span>
          <span>{{ $order->id }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Status:</span>
          <span class="badge
            @if($order->order_status == 'pending') badge-warning
            @elseif($order->order_status == 'completed') badge-success
            @else badge-danger
            @endif">
            {{ ucfirst($order->order_status) }}
          </span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Created At:</span>
          <span>{{ $order->created_at->format('Y-m-d H:i') }}</span>
        </div>

      </div>

      {{-- CUSTOMER --}}
      <div class="glow-info-box mb-4">
        <div class="glow-row">
          <span class="glow-label">Customer Email:</span>
          <span>{{ $order->customer->email ?? 'N/A' }}</span>
        </div>
      </div>

      {{--  ORDER ITEMS --}}
      <div class="glow-info-box">

        <h5 style="font-weight:700;">Order Items</h5>

        <div class="table-responsive mt-3">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
            </thead>

            <tbody>
              @foreach($order->items as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $item->product->product_name ?? 'N/A' }}</td>

                <td>${{ number_format($item->product->price, 2) }}</td>

                <td>{{ $item->quantity }}</td>

                <td>
                  ${{ number_format($item->total_price, 2) }}
                </td>
              </tr>
              @endforeach
            </tbody>

            <tfoot>
              <tr>
                <th colspan="4" class="text-right">Total</th>
                <th>${{ number_format($order->total_amount, 2) }}</th>
              </tr>
            </tfoot>

          </table>
        </div>

      </div>

    </div>

    <div class="card-footer">
      <a href="{{ route('cms.orders.index') }}" class="btn btn-light">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>

  </div>

</div>
@endsection
