@extends('cms.parent')

@section('title','Create Category')
@section('main-title','Categories')
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
          <i class="fas fa-folder-plus"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Add New Category</h3>
          <small class="text-muted">Create a new section to organize products</small>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('cms.categories.store') }}">
      @csrf

      <div class="card-body">
        <div class="hint-box mb-3">
          <strong>Tip:</strong> Your main categories are <b>Hair</b>, <b>Make up</b>, <b>Skin care</b>.
          You can add new categories if needed (e.g. Perfume, Body care…).
        </div>

        <div class="form-group">
          <label for="category_name" style="font-weight:600;">Category Name</label>
          <input type="text" id="category_name" name="category_name" class="form-control" placeholder="e.g. Perfume" maxlength="50" autofocus>
          <small class="text-muted">Max 50 characters. Must be unique.</small>
        </div>


        <div class="form-group mt-3">
          <label for="image_path" style="font-weight:600;">Category Image</label>
          <input type="file" id="image_path" name="image_path" class="form-control " accept="image/*">
          <small class="text-muted">JPG/PNG/WebP — Max 2MB.</small>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.categories.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
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
        formData.append('category_name' ,document.getElementById('category_name').value);
        formData.append('image_path',document.getElementById('image_path').files[0])
        store('/cms/admin/categories', formData)
    }
</script>
@endsection
