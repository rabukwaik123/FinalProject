@extends('cms.parent')
@section('title','Create Cart')
@section('main-title','Carts')
@section('sub-title','Create')

@section('styles')
<style>
    :root{
        --glow-pink:#c97c9d;
        --glow-pink-dark:#b46888;
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
            <h3>Add New Cart</h3>
        </div>

        <form onsubmit="event.preventDefault();">
            <div class="card-body">

                {{-- Customer --}}
                <div class="form-group">
                    <label>Customer</label>
                    <select id="customer_id" class="form-control">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->email }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Cart Status --}}
                <div class="form-group mt-3">
                    <label>Cart Status</label>
                    <select id="cart_status" class="form-control">
                        <option value="active">Active</option>
                        <option value="checked_out">Checked Out</option>
                        <option value="abandoned">Abandoned</option>
                    </select>
                </div>

                {{-- Cart Items --}}
                <div class="mt-4">
                    <h5>Cart Items</h5>
                    <div id="items-container"></div>
                    <button type="button" onclick="addRow()" class="btn btn-glow-pink btn-sm mt-2">
                        + Add Product
                    </button>
                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('cms.carts.index') }}" class="btn btn-light">Back</a>
                <button type="button" onclick="performStore()" class="btn btn-glow-pink">
                    Save
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

    function performStore(){
        let formData = new FormData();
        const redirectUrl = "{{ route('cms.carts.index') }}";

        formData.append('customer_id', document.getElementById('customer_id').value);
        formData.append('cart_status', document.getElementById('cart_status').value);

        let items = [];
        document.querySelectorAll('.item-row').forEach(row => {
            items.push({
                product_id: row.querySelector('.product_id').value,
                quantity:   row.querySelector('.quantity').value
            });
        });

        formData.append('items', JSON.stringify(items));

        storeRedirect('/cms/admin/carts', formData, redirectUrl);
    }
</script>
@endsection
