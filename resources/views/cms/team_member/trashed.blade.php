@extends('cms.parent')

@section('title','Trashed Members')
@section('main-title','Team Members')
@section('sub-title','Trashed')

@section('styles')
<style>
  :root{
    --glow-pink:#c97c9d;
    --glow-pink-dark:#b46888;
    --soft-line: rgba(0,0,0,.06);
    --soft-hover: #faf6f8;
  }

  .btn-glow-pink{
    background-color:var(--glow-pink);
    border-color:var(--glow-pink);
    color:#fff;
    border-radius: 10px;
    font-weight: 600;
  }
  .btn-glow-pink:hover{
    background-color:var(--glow-pink-dark);
    color:#fff;
  }

  .card-shift{
    margin-left: 0.5cm;
    margin-right: 0.5cm;
  }
  @media (max-width: 768px){
    .card-shift{ margin-left: 12px; margin-right: 12px; }
  }

  .table thead th{
    border-top: 0;
    text-transform: uppercase;
    letter-spacing: .05em;
    font-size: .78rem;
    color:#6c757d;
  }
  .table td, .table th{ vertical-align: middle; }
  .table-hover tbody tr:hover{ background: var(--soft-hover); }

  .member-name{ font-weight: 600; color: #111; }

  .action-btn{
    width: 34px; height: 34px; padding: 0;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 999px; border: 1px solid transparent;
    transition: .15s ease-in-out;
  }
  .action-btn i{ font-size: 14px; }

  /* Restore Button Style */
  .action-restore{ background: rgba(40, 167, 69, 0.12); color:#28a745; border-color: rgba(40, 167, 69, 0.18); }
  .action-restore:hover{ background: rgba(40, 167, 69, 0.22); color:#218838; }

  /* Final Delete Button Style */
  .action-delete{ background: rgba(230,81,81,.12); color:#e65151; border-color: rgba(230,81,81,.18); }
  .action-delete:hover{ background: rgba(230,81,81,.22); }

  .actions-group{
    display: inline-flex;
    gap: 8px;
    align-items: center;
    justify-content: center;
  }

  .member-thumb{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid rgba(0,0,0,.08);
    opacity: 0.7; /* تعتيم بسيط للدلالة على أنها محذوفة */
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card card-outline card-shift" style="border-top:3px solid #e65151;"> {{-- لون أحمر للسلة --}}
    <div class="card-header">
      <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div>
          <h3 class="card-title mb-0">Team Members - Recycle Bin</h3>
        </div>

        <div class="d-flex align-items-center" style="gap:10px;">
          <a href="{{ route('cms.team_members.index') }}" class="btn btn-glow-pink btn-sm">
            <i class="fas fa-arrow-left"></i> Back to Team
          </a>
          <a href="{{ route('cms.team_members_forceAll') }}" class="btn btn-danger btn-sm" onclick="return confirm('Clear all trash forever?')">
            <i class="fas fa-eraser"></i> Empty Trash
          </a>
        </div>
      </div>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th style="width:80px" class="text-center">#</th>
              <th style="width:100px" class="text-center">Photo</th>
              <th>Name</th>
              <th>Job Title</th>
              <th style="width:180px" class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody id="teamTable">
            @forelse($team_members as $member)
              <tr>
                <td class="text-muted text-center">{{ $member->id }}</td>
                <td class="text-center">
                  <img src="{{ asset($member->image_path ?? 'cms/dist/img/user-placeholder.png') }}" class="member-thumb">
                </td>
                <td>
                  <span class="member-name">{{ $member->name }}</span>
                </td>
                <td>
                  <span class="badge badge-secondary">{{ $member->job_title }}</span>
                </td>
                <td class="text-center">
                  <div class="actions-group">
                    {{-- زر الاستعادة --}}
                    <a href="{{ route('cms.team_members_restore', $member->id) }}" class="action-btn action-restore" data-toggle="tooltip" title="Restore Member">
                      <i class="fas fa-undo"></i>
                    </a>

                    {{-- زر الحذف النهائي --}}
                    <a href="{{ route('cms.team_members_force', $member->id) }}" class="action-btn action-delete" data-toggle="tooltip" title="Delete Permanently"
                       onclick="return confirm('Are you sure you want to delete this member forever?')">
                      <i class="fas fa-times-circle"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center text-muted p-5">
                    <i class="fas fa-trash-alt fa-3x mb-3" style="opacity: 0.2"></i><br>
                    Recycle bin is empty
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () { $('[data-toggle="tooltip"]').tooltip() })
</script>
@endsection