@extends('cms.parent')

@section('title','Show Product')
@section('main-title','Products')
@section('sub-title','Show')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
    --glow-pink-dark:#b46888;
    --soft-bg:#faf6f8;
    --soft-line: rgba(0,0,0,.08);
  }

  .card-shift{ margin-left:.5cm; margin-right:.5cm; }
  @media (max-width:768px){
    .card-shift{ margin-left:12px; margin-right:12px; }
  }

  .icon-circle{
    width: 38px; height: 38px;
    border-radius: 999px;
    background: rgba(201,124,157,.16);
    display:flex; align-items:center; justify-content:center;
    color: var(--glow-pink-dark);
  }

  .glow-info-box{
    background: var(--soft-bg);
    border: 1px solid rgba(201,124,157,.25);
    border-radius: 12px;
    padding: 14px 16px;
  }

  .glow-row{
    padding: 10px 0;
  }
  .glow-row + .glow-row{
    border-top: 1px solid rgba(0,0,0,.06);
  }

  .glow-label{
    font-weight:700;
    color:#333;
    display:inline-block;
    min-width: 150px;
    white-space: nowrap;
  }

  .glow-value{
    color:#111;
    display:inline-block;
  }

  .section-title{
    font-weight:700;
    color:#333;
    margin: 16px 0 10px;
  }

  .preview-wrap{
    max-width: 520px;
    border-radius: 14px;
    border: 1px solid rgba(201,124,157,.18);
    background: rgba(201,124,157,.06);
    padding: 12px;
  }

  .preview-img{
    width: 100%;
    height: 260px;
    border-radius: 12px;
    object-fit: cover;
    border: 1px solid rgba(0,0,0,.10);
    background: #fff;
  }

  .status-badge{
    display:inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: .85rem;
    font-weight: 700;
  }

  .status-active{
    background: rgba(40,167,69,.12);
    color: #28a745;
    border: 1px solid rgba(40,167,69,.18);
  }

  .status-inactive{
    background: rgba(220,53,69,.12);
    color: #dc3545;
    border: 1px solid rgba(220,53,69,.18);
  }
</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">

    <div class="card-header">
      <div class="d-flex align-items-center" style="gap:10px;">
        <div class="icon-circle"><i class="fas fa-eye"></i></div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Product Details</h3>
        </div>
      </div>
    </div>

    <div class="card-body">

      <div class="glow-info-box mb-4">
        <div class="glow-row">
          <span class="glow-label">Product Name:</span>
          <span class="glow-value">{{ $products->product_name }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Description:</span>
          <span class="glow-value">{{ $products->product_description ?? 'No description' }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Price:</span>
          <span class="glow-value">${{ number_format($products->price, 2) }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Category:</span>
          <span class="glow-value">{{ $products->category->category_name ?? 'N/A' }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Brand:</span>
          <span class="glow-value">{{ $products->brand->brand_name ?? 'N/A' }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Admin:</span>
          <span class="glow-value">{{ $products->admin->user->first_name ?? 'N/A' }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Status:</span>
          @if($products->is_active)
            <span class="status-badge status-active">Active</span>
          @else
            <span class="status-badge status-inactive">Inactive</span>
          @endif
        </div>
      </div>

      <div class="section-title">Product Image</div>

      @if(!empty($products->image_path))
        <div class="preview-wrap">
          <img src="{{ asset($products->image_path) }}" alt="product" class="preview-img">
        </div>
      @else
        <div class="text-muted">No image yet</div>
      @endif

    </div>

    <div class="card-footer">
      <a href="{{ route('cms.products.index') }}" class="btn btn-light"
         style="border:1px solid var(--soft-line); border-radius:10px;">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>

  </div>

</div>
@endsection
