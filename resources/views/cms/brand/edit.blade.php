@extends('cms.parent')

@section('title','Edit Brand')
@section('main-title','Brands')
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
          <h3 class="card-title mb-0" style="font-weight:700;">Edit brand</h3>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('cms.brands.update', $brands->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="card-body">

        <div class="form-group">
          <label for="brand_name" style="font-weight:600;">brand_name</label>
          <input type="text" id="brand_name" name="brand_name" value="{{ old('brand_name', $brands->brand_name) }}"class="form-control" maxlength="50" autofocus>
        </div>


      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.brands.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>
        <button type="button" onclick="performUpdate({{ $brands->id }})" class="btn btn-glow-pink">
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
        formData.append('brand_name' ,document.getElementById('brand_name').value);

        storeRoute('/cms/admin/brands_update/'+id , formData)
    }
</script>
@endsection
