@extends('cms.parent')

@section('title','Edit Cart')
@section('main-title','Carts')
@section('sub-title','Edit')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
    --glow-pink-dark:#b46888;
    --soft-bg:#faf6f8;
    --soft-line: rgba(0,0,0,.08);
  }
  .card-shift{ margin-left: 0.5cm; margin-right: 0.5cm; }
  @media (max-width:768px){
    .card-shift{ margin-left:12px; margin-right:12px; }
  }
  .btn-glow-pink{
    background-color:var(--glow-pink);
    border-color:var(--glow-pink);
    color:#fff;
    border-radius: 10px;
    font-weight: 600;
    padding: .55rem 1rem;
  }
  .btn-glow-pink:hover{
    background-color:var(--glow-pink-dark);
    border-color:var(--glow-pink-dark);
    color:#fff;
  }
  .form-control{ border-radius: 12px; }
  .form-control:focus{
    border-color: rgba(201,124,157,.6);
    box-shadow: 0 0 0 .2rem rgba(201,124,157,.18);
  }
  .icon-circle{
    width: 38px; height: 38px;
    border-radius: 999px;
    background: rgba(201,124,157,.16);
    display:flex;
    align-items:center;
    justify-content:center;
    color: var(--glow-pink-dark);
  }
  .info-box{
    background: #fff8fb;
    border: 1px solid rgba(201,124,157,.25);
    border-radius: 12px;
    padding: 12px 14px;
    color: #666;
    font-size: .92rem;
  }
  .item-row{
    display:flex;
    gap:10px;
    margin-top:10px;
    align-items:center;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle">
          <i class="fas fa-edit"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Edit Cart</h3>
        </div>
      </div>
    </div>

    <form onsubmit="event.preventDefault();">
      <div class="card-body">

        <div class="info-box mb-3">
          You can update the cart owner, its current status and its items.
        </div>

        {{-- Customer --}}
        <div class="form-group">
          <label for="customers_id" style="font-weight:600;">Customer</label>
          <select id="customers_id" name="customers_id" class="form-control">
            @foreach($customers as $customer)
              <option value="{{ $customer->id }}"
                {{ $customer->id == $cart->customers_id ? 'selected' : '' }}>
                {{ $customer->email }}
              </option>
            @endforeach
          </select>
        </div>




        {{-- Cart Status --}}
        <div class="form-group mt-3">
          <label for="cart_status" style="font-weight:600;">Cart Status</label>
          <select id="cart_status" name="cart_status" class="form-control">
            <option value="">Select Status</option>
            <option value="active"    {{ $cart->cart_status == 'active'    ? 'selected' : '' }}>Active</option>
            <option value="ordered"   {{ $cart->cart_status == 'ordered'   ? 'selected' : '' }}>Ordered</option>
            <option value="cancelled" {{ $cart->cart_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
          </select>
        </div>

        {{-- Cart Items --}}
        <div class="mt-4">
          <h5>Cart Items</h5>
          <div id="items-container">

            {{-- Load existing items --}}
            @foreach($cart->cartItems as $item)
            <div class="item-row">
              <select class="form-control product_id">
                @foreach($products as $product)
                  <option value="{{ $product->id }}"
                    {{ $item->products_id == $product->id ? 'selected' : '' }}>
                    {{ $product->product_name }} (${{ $product->price }})
                  </option>
                @endforeach
              </select>
              <input type="number" class="form-control quantity"
                     value="{{ $item->quantity }}" min="1">
              <button type="button" onclick="removeRow(this)" class="btn btn-danger">X</button>
            </div>
            @endforeach

          </div>
          <button type="button" onclick="addRow()" class="btn btn-glow-pink btn-sm mt-2">
            + Add Product
          </button>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.carts.index') }}" class="btn btn-light"
           style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>
        <button type="button" onclick="performUpdate({{ $cart->id }})" class="btn btn-glow-pink">
          <i class="fas fa-save"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function addRow(){
    let html = `
      <div class="item-row">
        <select class="form-control product_id">
          @foreach($products as $product)
            <option value="{{ $product->id }}">
              {{ $product->product_name }} (${{ $product->price }})
            </option>
          @endforeach
        </select>
        <input type="number" class="form-control quantity" value="1" min="1">
        <button type="button" onclick="removeRow(this)" class="btn btn-danger">X</button>
      </div>
    `;
    document.getElementById('items-container').insertAdjacentHTML('beforeend', html);
  }

  function removeRow(btn){
    btn.parentElement.remove();
  }

  function performUpdate(id){
    let formData = new FormData();

    formData.append('customers_id', document.getElementById('customers_id').value);
    formData.append('cart_status',  document.getElementById('cart_status').value);

    let items = [];
    document.querySelectorAll('.item-row').forEach(row => {
      items.push({
        product_id: row.querySelector('.product_id').value,
        quantity:   row.querySelector('.quantity').value
      });
    });

    formData.append('items', JSON.stringify(items));

    storeRoute('/cms/admin/carts_update/' + id, formData);
  }
</script>
@endsection
