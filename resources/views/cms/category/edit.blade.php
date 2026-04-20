@extends('cms.parent')

@section('title','Edit Category')
@section('main-title','Categories')
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

  .preview-img{
    width: 220px;
    height: 140px;
    border-radius: 14px;
    object-fit: cover;
    border: 1px solid rgba(0,0,0,.10);
    background: #fff;
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
          <h3 class="card-title mb-0" style="font-weight:700;">Edit Category</h3>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('cms.categories.update', $categories->id) }}" >
      @csrf
      @method('PUT')

      <div class="card-body">

        <div class="form-group">
          <label for="category_name" style="font-weight:600;">category_name</label>
          <input type="text" id="category_name" name="category_name" value="{{ $categories->category_name }}" class="form-control" maxlength="50" autofocus>
        </div>

        <div class="form-group mt-3">
          <label style="font-weight:600;">Current Image</label><br>

          @if(!empty($categories->image_path))
            <img src="{{ asset($categories->image_path) }}" alt="category" class="preview-img">
            <div class="text-muted mt-2" style="font-size:.9rem;">
              Path: <code>{{ $categories->image_path }}</code>
            </div>
          @else
            <div class="text-muted">No image yet</div>
          @endif
        </div>

        <div class="form-group mt-3">
          <label for="image_path" style="font-weight:600;">Change Image</label>
          <input type="file" id="image_path" name="image_path"  accept="image/*" value="image_path"class="form-control">
          <small class="text-muted">JPG/PNG/WebP — Max 2MB.</small>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.categories.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>
        <button type="button" onclick="performUpdate({{ $categories->id }})" class="btn btn-glow-pink">
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
        formData.append('category_name' ,document.getElementById('category_name').value);
        formData.append('image_path',document.getElementById('image_path').files[0])

        storeRoute('/cms/admin/categories_update/'+id , formData)
    }
</script>
@endsection
