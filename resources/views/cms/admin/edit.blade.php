@extends('cms.parent')

@section('title','Edit Admin')
@section('main-title','Admins')
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
          <i class="fas fa-user-shield"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Edit Admin</h3>
        </div>
      </div>
    </div>

    <form onsubmit="event.preventDefault();">
      <div class="card-body">

        <div class="info-box mb-3">
          You can update the admin's credentials and personal information. Leave password blank to keep it unchanged.
        </div>

        {{-- ACCOUNT INFO --}}
        <p class="section-title"><i class="fas fa-lock mr-1"></i> Account Info</p>

        <div class="form-group">
          <label for="email" style="font-weight:600;">Email</label>
          <input type="email" id="email" name="email"
                 value="{{ $admin->email }}"
                 class="form-control" maxlength="100" autofocus>
        </div>

        <div class="form-group mt-3">
          <label for="password" style="font-weight:600;">New Password</label>
          <input type="password" id="password" name="password"
                 class="form-control"
                 placeholder="Leave blank if you don't want to change it">
          <small class="text-muted">Minimum 6 characters if entered.</small>
        </div>

        {{-- PERSONAL INFO --}}
        <p class="section-title"><i class="fas fa-user mr-1"></i> Personal Info</p>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="first_name" style="font-weight:600;">First Name</label>
              <input type="text" id="first_name" name="first_name"
                     value="{{ $admin->user->first_name ?? '' }}"
                     class="form-control" maxlength="45">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="last_name" style="font-weight:600;">Last Name</label>
              <input type="text" id="last_name" name="last_name"
                     value="{{ $admin->user->last_name ?? '' }}"
                     class="form-control" maxlength="45">
            </div>
          </div>
        </div>

        <div class="form-group mt-3">
          <label for="phone" style="font-weight:600;">Phone</label>
          <input type="text" id="phone" name="phone"
                 value="{{ $admin->user->phone ?? '' }}"
                 class="form-control" maxlength="45">
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <div class="form-group">
              <label for="birth_month" style="font-weight:600;">Birth Month</label>
              <select id="birth_month" name="birth_month" class="form-control">
                <option value="">Select Month</option>
                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                  <option value="{{ $month }}"
                    {{ ($admin->user->birth_month ?? '') == $month ? 'selected' : '' }}>
                    {{ $month }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="birth_day" style="font-weight:600;">Birth Day</label>
              <input type="number" id="birth_day" name="birth_day"
                     value="{{ $admin->user->birth_day ?? '' }}"
                     class="form-control" min="1" max="31">
            </div>
          </div>
        </div>

        <div class="form-group mt-3">
          <label for="status" style="font-weight:600;">Status</label>
          <select id="status" name="status" class="form-control">
            <option value="active"   {{ ($admin->user->status ?? '') == 'active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ ($admin->user->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.admins.index') }}" class="btn btn-light"
           style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>
        <button type="button" onclick="performUpdate({{ $admin->id }})" class="btn btn-glow-pink">
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

        // Account fields
        formData.append('email',       document.getElementById('email').value);
        formData.append('password',    document.getElementById('password').value);

        // Personal fields
        formData.append('first_name',  document.getElementById('first_name').value);
        formData.append('last_name',   document.getElementById('last_name').value);
        formData.append('phone',       document.getElementById('phone').value);
        formData.append('birth_month', document.getElementById('birth_month').value);
        formData.append('birth_day',   document.getElementById('birth_day').value);
        formData.append('status',      document.getElementById('status').value);
         storeRoute('/cms/admin/admins_update/' + id, formData);


    }
</script>
@endsection
