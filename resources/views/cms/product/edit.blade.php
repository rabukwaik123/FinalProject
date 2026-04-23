@extends('cms.parent')

@section('title','Edit Product')
@section('main-title','Products')
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

  textarea.form-control{
    min-height: 120px;
    resize: vertical;
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
          <h3 class="card-title mb-0" style="font-weight:700;">Edit Product</h3>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('cms.products.update', $products->id) }}">
      @csrf
      @method('PUT')

      <div class="card-body">

        <div class="form-group">
          <label for="product_name" style="font-weight:600;">product_name</label>
          <input type="text" id="product_name" name="product_name" value="{{  $products->product_name }}"class="form-control" maxlength="100" autofocus>
        </div>

        <div class="form-group mt-3">
          <label for="product_description" style="font-weight:600;">product_description</label>
          <textarea id="product_description" name="product_description"class="form-control">{{ $products->product_description}}</textarea>
        </div>

        <div class="form-group mt-3">
          <label for="price" style="font-weight:600;">price</label>
          <input type="number" step="0.01" min="0" id="price" name="price" value="{{ $products->price}}"class="form-control">
        </div>

        <div class="form-group mt-3">
        <label for="category_id" style="font-weight:600;">category_name</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="">Select Category</option>
            @foreach($categories as $category)
            <option @if($category->id == $products->category_id) selected @endif value="{{ $category->id ?? ""}}">{{ $category->category_name}}
            </option>
            @endforeach
        </select>
        </div>

        <div class="form-group mt-3">
        <label for="brand_id" style="font-weight:600;">brand_name</label>
        <select id="brand_id" name="brand_id" class="form-control">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
            <option @if($brand->id == $products->brand_id) selected @endif value="{{ $brand->id ?? "" }}">{{ $brand->brand_name }}
            </option>
            @endforeach
        </select>
        </div>


        {{--  <div class="form-group col-md-6">
            <label for="admin_id" style="font-weight:600;">Admin Name</label>
            <select id="admin_id" name="brand_id" class="form-control">
              <option value="">Select Admin</option>
              @foreach($admins as $admin)
                <option value="{{ $admin->id }}">{{ $admin->user->first_name }}</option>
              @endforeach
            </select>
          </div>
        </div>  --}}


        <input type="text" name="admin_id" id="admin_id" value="{{ $id }}" class="form-control form-control-solid" hidden/>

        <div class="form-group mt-3">
        <label for="is_active" style="font-weight:600;">is_active</label>
        <select id="is_active" name="is_active" class="form-control">
            <option @if($products->is_active == 1) selected @endif value="1">Active</option>
            <option @if($products->is_active == 0) selected @endif value="0">Inactive</option>
        </select>
        </div>

        <div class="form-group mt-3">
          <label style="font-weight:600;">Current Image</label><br>

          @if(!empty($products->image_path))
            <img src="{{ asset($products->image_path) }}" alt="product" class="preview-img">
            <div class="text-muted mt-2" style="font-size:.9rem;">
              Path: <code>{{ $products->image_path }}</code>
            </div>
          @else
            <div class="text-muted">No image yet</div>
          @endif
        </div>

        <div class="form-group mt-3">
          <label for="image_path" style="font-weight:600;">Change Image</label>
          <input type="file" id="image_path"  name="image_path" class="form-control">
          <small class="text-muted">JPG/PNG/WebP — Max 2MB.</small>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.products.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>
        <button type="button" onclick="performUpdate({{ $products->id }})" class="btn btn-glow-pink">
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
        formData.append('product_name', document.getElementById('product_name').value);
        formData.append('product_description', document.getElementById('product_description').value);
        formData.append('price', document.getElementById('price').value);
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('brand_id', document.getElementById('brand_id').value);
        formData.append('admin_id', document.getElementById('admin_id').value);
        formData.append('is_active', document.getElementById('is_active').value);
        formData.append('image_path',document.getElementById('image_path').files[0])
        storeRoute('/cms/admin/products_update/' + id , formData)
    }
</script>
@endsection
