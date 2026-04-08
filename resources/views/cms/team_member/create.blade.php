@extends('cms.parent')

@section('title','Add Member')
@section('main-title','Team Members')
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
          <i class="fas fa-user-plus"></i>
        </div>
        <div>
          <h3 class="card-title mb-0" style="font-weight:700;">Add New Team Member</h3>
          <small class="text-muted">Register a new specialist to your beauty shop team</small>
        </div>
      </div>
    </div>

    <form>
      <div class="card-body">
        <div class="hint-box mb-3">
          <strong>Tip:</strong> Make sure to enter the professional <b>Job Title</b> correctly (e.g. Makeup Artist, Hair Stylist) to be shown on the website.
        </div>

        <div class="form-group">
          <label for="name" style="font-weight:600;">Member Full Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Sarah Ahmed" maxlength="50" autofocus>
          <small class="text-muted">Enter the specialist's full name.</small>
        </div>

        <div class="form-group mt-3">
          <label for="job_title" style="font-weight:600;">Job Title</label>
          <input type="text" id="job_title" name="job_title" class="form-control" placeholder="e.g. Hair Stylist" maxlength="50">
          <small class="text-muted">e.g. Skin Care Expert, Makeup Artist.</small>
        </div>


        <div class="form-group mt-3">
          <label for="image_path" style="font-weight:600;">Member Photo</label>
          <input type="file" id="image_path" name="image_path" class="form-control ">
          <small class="text-muted">JPG/PNG/WebP — Max 2MB. A square portrait is recommended.</small>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-between align-items-center">
        <a href="{{ route('cms.team_members.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
          <i class="fas fa-arrow-left"></i> Back
        </a>

        <button type="button" onclick="performStore()" class="btn btn-glow-pink">
          <i class="fas fa-save"></i> Save Member
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
        formData.append('name', document.getElementById('name').value);
        formData.append('job_title', document.getElementById('job_title').value);
        
        let img = document.getElementById('image_path');
        if (img.files[0]) {
            formData.append('image_path', img.files[0]);
        }

        store('/cms/admin/team_members', formData);
    }
</script>
@endsection