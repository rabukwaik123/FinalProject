@extends('cms.parent')

@section('title','Edit Member')
@section('main-title','Team Members')
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
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--glow-pink);
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
                    <i class="fas fa-user-edit"></i>
                </div>
                <div>
                    <h3 class="card-title mb-0" style="font-weight:700;">Edit Member Profile</h3>
                    <small class="text-muted">Update information for: {{ $team_member->name }}</small>
                </div>
            </div>
        </div>

        <form>
            <div class="card-body">

                <div class="form-group">
                    <label for="name" style="font-weight:600;">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ $team_member->name }}" class="form-control" maxlength="50" autofocus>
                </div>

                <div class="form-group mt-3">
                    <label for="job_title" style="font-weight:600;">Job Title</label>
                    <input type="text" id="job_title" name="job_title" value="{{ $team_member->job_title }}" class="form-control" maxlength="50">
                </div>

                <div class="form-group mt-3">
                    <label for="bio" style="font-weight:600;">Member Bio</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3">{{ $team_member->bio }}</textarea>
                </div>

                <div class="form-group mt-3 text-center">
                    <label style="font-weight:600;" class="d-block text-left">Current Profile Photo</label>

                    @if(!empty($team_member->image_path))
                        <img src="{{ asset($team_member->image_path) }}" alt="member" class="preview-img mb-2" accept="image/*">
                    @else
                        <div class="text-muted">No photo uploaded yet</div>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <label for="image_path" style="font-weight:600;">Change Profile Photo</label>
                    <input type="file" id="image_path" name="image_path" class="form-control">
                    <small class="text-muted">JPG/PNG/WebP — Max 2MB.</small>
                </div>

            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="{{ route('cms.team_members.index') }}" class="btn btn-light" style="border:1px solid var(--soft-line); border-radius:10px;">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="button" onclick="performUpdate({{ $team_member->id }})" class="btn btn-glow-pink">
                    <i class="fas fa-save"></i> Update Profile
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
        formData.append('name', document.getElementById('name').value);
        formData.append('job_title', document.getElementById('job_title').value);
        formData.append('bio', document.getElementById('bio').value);
        formData.append('image_path',document.getElementById('image_path').files[0])
        store('/cms/admin/team_members_update/' + id, formData);
    }
</script>
@endsection
