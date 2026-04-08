@extends('cms.parent')

@section('title','Show Member')
@section('main-title','Team Members')
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

  .path-code{
    color: var(--glow-pink-dark);
    background: rgba(201,124,157,.10);
    border: 1px solid rgba(201,124,157,.20);
    padding: 4px 8px;
    border-radius: 8px;
    word-break: break-all;
    display:inline-block;
  }

  .section-title{
    font-weight:700;
    color:#333;
    margin: 16px 0 10px;
  }

  .preview-wrap{
    max-width: 300px; 
    border-radius: 50%; 
    border: 3px solid var(--glow-pink);
    background: rgba(201,124,157,.06);
    padding: 8px;
    margin: 0 auto; 
  }

  .preview-img{
    width: 100%;
    height: 280px;
    border-radius: 50%;
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
        <div class="icon-circle"><i class="fas fa-user-tie"></i></div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Member Details</h3>
        </div>
      </div>
    </div>

    <div class="card-body">

      <div class="glow-info-box mb-4">
        <div class="glow-row">
          <span class="glow-label">Full Name:</span>
          <span class="glow-value">{{ $team_member->name }}</span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Job Title:</span>
          <span class="glow-value"><span class="badge" style="background: var(--glow-pink); color: #fff;">{{ $team_member->job_title }}</span></span>
        </div>

        <div class="glow-row">
          <span class="glow-label">Image Path:</span>
          <code class="path-code">{{ $team_member->image_path ?? 'No image' }}</code>
        </div>
      </div>

      <div class="section-title text-center">Member Profile Photo</div>

      @if(!empty($team_member->image_path))
        <div class="preview-wrap">
          <img src="{{ asset($team_member->image_path) }}" alt="member" class="preview-img">
        </div>
      @else
        <div class="text-center text-muted">No photo uploaded yet</div>
      @endif

    </div>

    <div class="card-footer">
      <a href="{{ route('cms.team_members.index') }}" class="btn btn-light"
         style="border:1px solid var(--soft-line); border-radius:10px;">
        <i class="fas fa-arrow-left"></i> Back to Team
      </a>
    </div>

  </div>

</div>
@endsection