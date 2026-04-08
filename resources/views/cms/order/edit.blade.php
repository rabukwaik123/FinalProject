@extends('cms.parent')

@section('title','Edit Order')
@section('main-title','Orders')
@section('sub-title','Edit')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
  }

  .card-shift{
    margin-left: 0.5cm;
    margin-right: 0.5cm;
  }

  .btn-glow-pink{
    background-color:var(--glow-pink);
    color:#fff;
    border-radius: 10px;
  }

  .item-row{
    display:flex;
    gap:10px;
    margin-top:10px;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">

    <div class="card-header">
      <h3>Edit Order</h3>
    </div>

    <form onsubmit="event.preventDefault();">

      <div class="card-body">

        {{-- Customer --}}
        <div class="form-group">
          <label>Customer</label>
          <select id="customer_id" class="form-control">
            @foreach($customers as $customer)
              <option value="{{ $customer->id }}"
                {{ $customer->id == $order->customer_id ? 'selected' : '' }}>
                {{ $customer->email }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Status --}}
        <div class="form-group mt-3">
          <label>Status</label>
          <select id="order_status" class="form-control">
            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
          </select>
        </div>

        {{-- ITEMS --}}
        <div class="mt-4">
          <h5>Order Items</h5>

          <div id="items-container">

            {{-- EXISTING ITEMS --}}
            @foreach($order->items as $item)
            <div class="item-row">

                <select class="form-control product_id">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            {{ $product->id == $item->product_id ? 'selected' : '' }}>
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

      <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('cms.orders.index') }}" class="btn btn-light">Back</a>

        <button type="button" onclick="performUpdate({{ $order->id }})" class="btn btn-glow-pink">
          Update
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

    formData.append('customer_id', document.getElementById('customer_id').value);
    formData.append('order_status', document.getElementById('order_status').value);

    let items = [];

    document.querySelectorAll('.item-row').forEach(row => {
        items.push({
            product_id: row.querySelector('.product_id').value,
            quantity: row.querySelector('.quantity').value
        });
    });

    console.log("Items:", items);

    if(items.length === 0){
        alert('Please add at least one product');
        return;
    }

    formData.append('items', JSON.stringify(items));

    formData.append('_method', 'PUT');

    storeRoute('/cms/admin/orders/' + id, formData);
}

</script>
@endsection
