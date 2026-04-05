@extends('cms.parent')

@section('title','Create Cart')
@section('main-title','Carts')
@section('sub-title','Create')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
    --glow-pink-dark:#b46888;
    --soft-bg:#faf6f8;
    --soft-line: rgba(0,0,0,.08);
  }

  .card-shift{
    margin-left: 0.5cm;
    margin-right: 0.5cm;
  }
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

  .hint-box{
    background: var(--soft-bg);
    border: 1px solid rgba(201,124,157,.25);
    border-radius: 12px;
    padding: 12px 14px;
    color: #5b5b5b;
    font-size: .92rem;
  }

  .form-control{
    border-radius: 12px;
  }
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
</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Add New Cart</h3>
          <small class="text-muted">Create a new shopping cart for a customer</small>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('cms.carts.store') }}">
      @csrf

      <div class="card-body">
        <div class="hint-box mb-3">
          <strong>Tip:</strong> Select the customer first, then choose the cart status.
        </div>

        <div class="form-group">
          <label for="customers_id" style="font-weight:600;">Customer</label>
          <select id="customers_id" name="customers_id" class="form-control">
            <option value="">Select Customer</option>
            @foreach($customers as $customer)
              <option value="{{ $customer->id }}">{{ $customer->email }}</option>
            @endforeach
          </select>
          <small class="text-muted">Choose the customer who owns this cart.</small>
        </div>

        <div class="form-group mt-3">
          <label for="cart_status" style="font-weight:600;">Cart Status</label>
          <select id="cart_status" name="cart_status" class="form-control">
            <option value="">Select Status</option>
            <option value="active">Active</option>
            <option value="ordered">Ordered</option>
            <option value="cancelled">Cancelled</option>
          </select>
          <small class="text-muted">Set the current status of the cart.</small>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.carts.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>

        <button type="button" onclick="performStore()" class="btn btn-glow-pink">
          <i class="fas fa-save"></i> Save
        </button>
      </div>
    </form>
  </div>

</div>
@endsection

@section('scripts')
<script>
    function performStore(){
        let formData = new FormData();
        formData.append('customers_id', document.getElementById('customers_id').value);
        formData.append('cart_status', document.getElementById('cart_status').value);

        store('/cms/admin/carts', formData)
    }
</script>
@endsection
