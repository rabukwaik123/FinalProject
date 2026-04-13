@extends('cms.parent')

@section('title','Edit Customer')
@section('main-title','Customers')
@section('sub-title','Edit')

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

  .info-box{
    background: #fff8fb;
    border: 1px solid rgba(201,124,157,.25);
    border-radius: 12px;
    padding: 12px 14px;
    color: #666;
    font-size: .92rem;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle">
          <i class="fas fa-user-edit"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Edit Customer</h3>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('cms.customers.update', $customer->id) }}">
      @csrf
      @method('PUT')

      <div class="card-body">

        <div class="info-box mb-3">
          You can update the customer's email, and leave the password empty if you do not want to change it.
        </div>

        <div class="form-group">
          <label for="email" style="font-weight:600;">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ $customer->email }}"
            class="form-control"
            maxlength="100"
            autofocus
          >
        </div>

        <div class="form-group mt-3">
          <label for="password" style="font-weight:600;">New Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="form-control"
            placeholder="Leave blank if you don't want to change it"
          >
          <small class="text-muted">Minimum 6 characters if entered.</small>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.customers.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>

        <button type="button" onclick="performUpdate({{ $customer->id }})" class="btn btn-glow-pink">
          <i class="fas fa-save"></i> Update
        </button>
      </div>
    </form>
  </div>

</div>
@endsection

@section('scripts')
<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);

        storeRoute('/cms/admin/customers_update/' + id, formData);
    }
</script>
@endsection
