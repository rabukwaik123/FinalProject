@extends('cms.parent')

@section('title','Home')
{{--  @section('main-title','Home')  --}}
@section('sub-title','Glow Beauty Shop')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
    --glow-pink-dark:#b46888;
    --glow-bg:#fef2f4;
    --soft-line: rgba(0,0,0,.06);
    --soft-shadow: 0 10px 22px rgba(0,0,0,.05);
  }

  .content-wrapper{ background: var(--glow-bg); }

  .glow-hero{
    border-radius: 18px;
    border: 1px solid rgba(201,124,157,.22);
    background: linear-gradient(135deg, rgba(201,124,157,.18), rgba(255,255,255,.92));
    padding: 18px 18px;
    display:flex;
    align-items:center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
    box-shadow: var(--soft-shadow);
  }
  .glow-hero h2{ margin:0; font-weight: 950; color:#2c2c2c; }
  .glow-hero p{ margin:6px 0 0; color:#666; font-weight:600; }

  .btn-glow{
    background: var(--glow-pink);
    border-color: var(--glow-pink);
    color:#fff;
    border-radius: 12px;
    font-weight: 900;
    padding: .55rem 1rem;
  }
  .btn-glow:hover{ background: var(--glow-pink-dark); border-color: var(--glow-pink-dark); color:#fff; }

  .btn-soft{
    border-radius: 12px;
    border:1px solid rgba(201,124,157,.25);
    font-weight: 900;
    background:#fff;
  }

  .stat-tile{
    background:#fff;
    border: 1px solid rgba(201,124,157,.18);
    border-radius: 18px;
    padding: 16px;
    display:flex;
    align-items:center;
    justify-content: space-between;
    gap: 14px;
    box-shadow: var(--soft-shadow);
    height: 100%;
  }
  .stat-label{ color:#777; font-weight: 900; letter-spacing: .2px; }
  .stat-value{ font-size: 26px; font-weight: 950; color:#222; margin-top: 4px; line-height: 1.1; }
  .stat-icon{
    width: 48px; height: 48px;
    border-radius: 16px;
    display:flex; align-items:center; justify-content:center;
    background: rgba(201,124,157,.16);
    color: var(--glow-pink-dark);
    font-size: 18px;
    flex: 0 0 auto;
  }


</style>
@endsection

@section('content')
<div class="container-fluid">

  <div class="glow-hero">
    <div>
      <h2>Glow Beauty Shop</h2>
    </div>

    <div class="d-flex" style="gap:10px; flex-wrap:wrap;">
      <a href="{{ route('cms.categories.index') }}" class="btn btn-soft">
        <i class="fas fa-tags"></i> Categories
      </a>
      <a href="{{ route('cms.categories.create') }}" class="btn btn-glow">
        <i class="fas fa-plus"></i> Add Category
      </a>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Categories</div>
          <div class="stat-value">{{ $dashboards['categories'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-tags"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Brands</div>
          <div class="stat-value">{{ $dashboards['brands'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-copyright"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Products</div>
          <div class="stat-value">{{ $dashboards['products'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-box-open"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Orders</div>
          <div class="stat-value">{{ $dashboards['orders'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Customers</div>
          <div class="stat-value">{{ $dashboards['customers'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-user"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Carts</div>
          <div class="stat-value">{{ $dashboards['carts'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Messages</div>
          <div class="stat-value">{{ $dashboards['messages'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-envelope"></i></div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-3">
      <div class="stat-tile">
        <div>
          <div class="stat-label">Team Members</div>
          <div class="stat-value">{{ $dashboards['team'] ?? 0 }}</div>
        </div>
        <div class="stat-icon"><i class="fas fa-users"></i></div>
      </div>
    </div>
  </div>

  </div>

</div>
@endsection
