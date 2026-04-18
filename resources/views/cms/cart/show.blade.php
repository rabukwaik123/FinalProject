@extends('cms.parent')

@section('title','Show Cart')
@section('main-title','Carts')
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
  @media (max-width:768px){
    .card-shift{ margin-left:12px; margin-right:12px; }
  }

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
  .glow-row + .glow-row{
    border-top: 1px solid rgba(0,0,0,.06);
  }

  .glow-label{
    font-weight:700;
    color:#333;
    display:inline-block;
    min-width: 150px;
    white-space: nowrap;
  }

  .glow-value{
    color:#111;
    display:inline-block;
    word-break: break-word;
  }

  .status-badge{
    padding: .45rem .8rem;
    border-radius: 999px;
    font-size: .8rem;
    font-weight: 600;
    display: inline-block;
  }

  .status-active{
    background: rgba(40,167,69,.12);
    color: #28a745;
    border: 1px solid rgba(40,167,69,.18);
  }

  .status-ordered{
    background: rgba(201,124,157,.12);
    color: var(--glow-pink-dark);
    border: 1px solid rgba(201,124,157,.18);
  }

  .status-cancelled{
    background: rgba(230,81,81,.12);
    color: #e65151;
    border: 1px solid rgba(230,81,81,.18);
  }

  .email-code{
    color: var(--glow-pink-dark);
    background: rgba(201,124,157,.10);
    border: 1px solid rgba(201,124,157,.20);
    padding: 4px 8px;
    border-radius: 8px;
    word-break: break-all;
    display:inline-block;
  }

  .section-title{
    font-weight:700;
    color:#333;
    margin: 16px 0 10px;
  }

  .items-table{
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,.06);
  }

  .items-table thead th{
    background:#fff7fa;
    color:#555;
    font-size:.85rem;
    text-transform: uppercase;
    letter-spacing:.03em;
  }

  .items-table td, .items-table th{
    vertical-align: middle;
  }

  .price-badge{
    background: rgba(201,124,157,.12);
    color: var(--glow-pink-dark);
    border: 1px solid rgba(201,124,157,.18);
    padding: .35rem .7rem;
    border-radius: 999px;
    font-size: .82rem;
    font-weight: 600;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">

    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle"><i class="fas fa-eye"></i></div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Cart Details</h3>
        </div>
      </div>
    </div>

    <div class="card-body">

      <div class="glow-info-box mb-4">
        <div class="glow-row">
          <span class="glow-label">Cart ID:</span>
          <span class="glow-value">{{ $cart->id }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Customer:</span>
          <code class="email-code">{{ $cart->customer->email ?? 'No customer' }}</code>
        </div>

        <div class="glow-row">
          <span class="glow-label">Cart Status:</span>
          @if($cart->cart_status == 'active')
            <span class="status-badge status-active">Active</span>
          @elseif($cart->cart_status == 'ordered')
            <span class="status-badge status-ordered">Ordered</span>
          @else
            <span class="status-badge status-cancelled">Cancelled</span>
          @endif
        </div>

        <div class="glow-row">
          <span class="glow-label">Created At:</span>
          <span class="glow-value">{{ $cart->created_at ? $cart->created_at->format('Y-m-d h:i A') : '-' }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Updated At:</span>
          <span class="glow-value">{{ $cart->updated_at ? $cart->updated_at->format('Y-m-d h:i A') : '-' }}</span>
        </div>
      </div>

      <div class="section-title">Cart Items</div>

      @if($cart->cartItems->count() > 0)
        <div class="table-responsive items-table">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th style="width:80px" class="text-center">#</th>
                <th>Product</th>
                <th style="width:120px" class="text-center">Quantity</th>
                <th style="width:160px" class="text-center">Total Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cart->cartItems as $item)
                <tr>
                  <td class="text-center text-muted">{{ $item->id }}</td>
                  <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                  <td class="text-center">{{ $item->quantity }}</td>
                  <td class="text-center">
                    <span class="price-badge">{{ $item->total_price }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="text-muted">No items found in this cart.</div>
      @endif

    </div>

    <div class="card-footer">
      <a href="{{ route('cms.carts.index') }}" class="btn btn-light"
         style="border:1px solid var(--soft-line); border-radius:10px;">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>

  </div>

</div>
@endsection
