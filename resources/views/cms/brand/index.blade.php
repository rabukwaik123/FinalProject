@extends('cms.parent')

@section('title','Brands')
@section('main-title','Brands')
@section('sub-title','Index')

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
    border-color:var(--glow-pink-dark);
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

  .table thead th:nth-child(1), .table tbody td:nth-child(1),
  .table thead th:nth-child(2), .table tbody td:nth-child(2),
  .table thead th:nth-child(3), .table tbody td:nth-child(3){
    border-right: 1px solid var(--soft-line);
  }

  .cat-name{ font-weight: 600; color: #111; }

  .action-btn{
    width: 34px; height: 34px; padding: 0;
    display: inline-flex; align-items: center; justify-content: center;
    border-radius: 999px; border: 1px solid transparent;
    transition: .15s ease-in-out;
  }
  .action-btn i{ font-size: 14px; }

  .action-show{ background: rgba(108,117,125,.12); color:#6c757d; border-color: rgba(108,117,125,.18); }
  .action-show:hover{ background: rgba(108,117,125,.22); }

  .action-edit{ background: rgba(201,124,157,.16); color: var(--glow-pink-dark); border-color: rgba(201,124,157,.22); }
  .action-edit:hover{ background: rgba(201,124,157,.28); }

  .action-delete{ background: rgba(230,81,81,.12); color:#e65151; border-color: rgba(230,81,81,.18); }
  .action-delete:hover{ background: rgba(230,81,81,.22); }

  .actions-group{
    display: inline-flex;
    gap: 8px;
    align-items: center;
    justify-content: center;
  }

  .pagination .page-link{ color: var(--glow-pink-dark); }
  .pagination .page-item.active .page-link{
    background-color: var(--glow-pink);
    border-color: var(--glow-pink);
    color: #fff;
  }
  .pagination .page-link:focus{ box-shadow: none; }
  .pagination .page-item.disabled .page-link{ color: #aaa; }

  .cat-thumb{
    width: 70px;
    height: 45px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid rgba(0,0,0,.08);
    background: #fff;
  }
  .cat-thumb-placeholder{
    width: 70px;
    height: 45px;
    border-radius: 10px;
    border: 1px dashed rgba(0,0,0,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#999;
    font-size: 12px;
    background:#fff;
  }

</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
    <div class="card-header">
      <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div>
          <h3 class="card-title mb-0">Brands</h3>
        </div>

        <div class="d-flex align-items-center" style="gap:10px;">
          <div class="input-group input-group-sm" style="width: 240px;">
            <input id="catSearch" type="text" class="form-control" placeholder="Search brand...">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
          </div>

          <a href="{{ route('cms.brands.create') }}" class="btn btn-glow-pink btn-sm">
            <i class="fas fa-plus"></i> Add new brand
          </a>
        </div>
      </div>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-striped mb-0">
          <thead>
            <tr>
              <th style="width:80px" class="text-center">#</th>
            <th>Name</th>
              <th>Number of products</th>
              <th style="width:200px" class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody id="catTable">
            @forelse($brands as $brand)
              <tr>
                <td class="text-muted text-center">{{ $brand->id }}</td>

                <td>
                  <span class="cat-name">{{ $brand->brand_name }}</span>
                </td>

                <td>
                  <span class="badge bg-pink">{{ $brand->products_count }}</span>
                </td>


                <td class="text-center">
                  <div class="actions-group">
                    <a href="{{ route('cms.brands.show', $brand->id) }}" class="action-btn action-show" data-toggle="tooltip" title="Show">
                      <i class="fas fa-eye"></i>
                    </a>

                    <a href="{{ route('cms.brands.edit', $brand->id) }}" class="action-btn action-edit" data-toggle="tooltip" title="Edit">
                      <i class="fas fa-pen"></i>
                    </a>

                    <form action="{{ route('cms.brands.destroy', $brand) }}" method="POST" class="m-0">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="performDestroy({{ $brand->id }}, this)" class="action-btn action-delete" data-toggle="tooltip" title="Delete"
                              onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted p-4">No Brands found</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="card-footer d-flex align-items-center flex-wrap" style="gap:10px;">
      <small class="text-muted">
        Total: {{ $brands->total() }} Brands
      </small>

      <div class="ml-auto">
        {{ $brands->links() }}
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script>

    $(function () { $('[data-toggle="tooltip"]').tooltip() })

    $('#catSearch').on('keyup', function () {
        const q = $(this).val().toLowerCase();
        $('#catTable tr').each(function () {
        const text = $(this).text().toLowerCase();
        $(this).toggle(text.includes(q));
        });
    });


    function performDestroy(id , reference){

        confirmDestroy('/cms/admin/brands/'+id , reference);
    }

</script>
@endsection
