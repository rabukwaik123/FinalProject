@extends('cms.parent')

@section('title','Create Customer')
@section('main-title','Customers')
@section('sub-title','Create')

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
  .hint-box{
    background: var(--soft-bg);
    border: 1px solid rgba(201,124,157,.25);
    border-radius: 12px;
    padding: 12px 14px;
    color: #5b5b5b;
    font-size: .92rem;
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
  .section-title{
    font-weight: 700;
    color: var(--glow-pink-dark);
    border-bottom: 1px solid rgba(201,124,157,.2);
    padding-bottom: 6px;
    margin-bottom: 16px;
    margin-top: 24px;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle">
          <i class="fas fa-user-plus"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Add New Customer</h3>
          <small class="text-muted">Create a new customer account</small>
        </div>
      </div>
    </div>

    <form onsubmit="event.preventDefault();">
      <div class="card-body">

        <div class="hint-box mb-3">
          <strong>Tip:</strong> Fill in the customer credentials and personal information.
        </div>

        {{-- CUSTOMER ACCOUNT --}}
        <p class="section-title"><i class="fas fa-lock mr-1"></i> Account Info</p>

        <div class="form-group">
          <label for="email" style="font-weight:600;">Email</label>
          <input type="email" id="email" name="email" class="form-control"
                 placeholder="e.g. customer@example.com" maxlength="100" autofocus>
          <small class="text-muted">Must be unique.</small>
        </div>

        <div class="form-group mt-3">
          <label for="password" style="font-weight:600;">Password</label>
          <input type="password" id="password" name="password" class="form-control"
                 placeholder="Enter password">
          <small class="text-muted">Minimum 6 characters.</small>
        </div>

        {{-- USER PERSONAL INFO --}}
        <p class="section-title"><i class="fas fa-user mr-1"></i> Personal Info</p>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name" style="font-weight:600;">First Name</label>
              <input type="text" id="first_name" name="first_name" class="form-control"
                     placeholder="e.g. John" maxlength="45">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="last_name" style="font-weight:600;">Last Name</label>
              <input type="text" id="last_name" name="last_name" class="form-control"
                     placeholder="e.g. Doe" maxlength="45">
            </div>
          </div>
        </div>

        <div class="form-group mt-3">
          <label for="phone" style="font-weight:600;">Phone</label>
          <input type="text" id="phone" name="phone" class="form-control"
                 placeholder="e.g. +1234567890" maxlength="45">
          <small class="text-muted">Must be unique.</small>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <div class="form-group">
              <label for="birth_month" style="font-weight:600;">Birth Month</label>
              <select id="birth_month" name="birth_month" class="form-control">
                <option value="">Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="birth_day" style="font-weight:600;">Birth Day</label>
              <input type="number" id="birth_day" name="birth_day" class="form-control"
                     placeholder="e.g. 15" min="1" max="31">
            </div>
          </div>
        </div>

        <div class="form-group mt-3">
          <label for="status" style="font-weight:600;">Status</label>
          <select id="status" name="status" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.customers.index') }}" class="btn btn-light"
           style="border:1px solid var(--soft-line); border-radius:10px;">
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
         const redirectUrl = "{{ route('cms.customers.index') }}";

        // Customer account fields
        formData.append('email',       document.getElementById('email').value);
        formData.append('password',    document.getElementById('password').value);

        // User personal fields
        formData.append('first_name',  document.getElementById('first_name').value);
        formData.append('last_name',   document.getElementById('last_name').value);
        formData.append('phone',       document.getElementById('phone').value);
        formData.append('birth_month', document.getElementById('birth_month').value);
        formData.append('birth_day',   document.getElementById('birth_day').value);
        formData.append('status',      document.getElementById('status').value);

        store('/cms/admin/customers', formData);
    }
</script>
@endsection
