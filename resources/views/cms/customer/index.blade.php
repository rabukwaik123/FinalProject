@extends('cms.parent')

@section('title','Customers')
@section('main-title','Customers')
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

  .customer-email{ font-weight: 600; color: #111; }

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

  .email-badge{
    background: rgba(201,124,157,.12);
    color: var(--glow-pink-dark);
    border: 1px solid rgba(201,124,157,.18);
    padding: .4rem .7rem;
    border-radius: 999px;
    font-size: .82rem;
    font-weight: 600;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="card card-outline card-shift" style="border-top:3px solid var(--glow-pink);">
    <div class="card-header">
      <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div>
          <h3 class="card-title mb-0">Customers</h3>
        </div>

        <div class="d-flex align-items-center" style="gap:10px;">
          <div class="input-group input-group-sm" style="width: 240px;">
            <input id="customerSearch" type="text" class="form-control" placeholder="Search customer...">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
          </div>

          <a href="{{ route('cms.customers.create') }}" class="btn btn-glow-pink btn-sm">
            <i class="fas fa-plus"></i> Add new customer
          </a>

          <a href="{{ route('cms.customers_trashed') }}" class="btn btn-danger btn-sm">
            Trashed
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
              <th>Email</th>
              <th>Name</th>
              <th>Phone</th>
              <th style="width:180px" class="text-center">Created At</th>
              <th style="width:200px" class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody id="customerTable">
            @forelse($customers as $customer)
              <tr>
                <td class="text-muted text-center">{{ $customer->id }}</td>

                <td>
                  <span class="customer-email">{{ $customer->email }}</span>
                </td>
                <td>
                  {{-- accessed via morph relation --}}
                  {{ $customer->user->first_name ?? '-' }} {{ $customer->user->last_name ?? '' }}
                </td>


                <td>
                  {{ $customer->user->phone ?? '-' }}
                </td>

                <td class="text-center">
                  <span class="email-badge">
                    {{ $customer->created_at ? $customer->created_at->format('Y-m-d') : '-' }}
                  </span>
                </td>

                <td class="text-center">
                  <div class="actions-group">
                    <a href="{{ route('cms.customers.show', $customer->id) }}" class="action-btn action-show" data-toggle="tooltip" title="Show">
                      <i class="fas fa-eye"></i>
                    </a>

                    <a href="{{ route('cms.customers.edit', $customer->id) }}" class="action-btn action-edit" data-toggle="tooltip" title="Edit">
                      <i class="fas fa-pen"></i>
                    </a>

                    <form action="{{ route('cms.customers.destroy', $customer) }}" method="POST" class="m-0">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="performDestroy({{ $customer->id }}, this)" class="action-btn action-delete" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted p-4">No customers found</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="card-footer d-flex align-items-center flex-wrap" style="gap:10px;">
      <small class="text-muted">
        Total: {{ $customers->total() }} customers
      </small>

      <div class="ml-auto">
        {{ $customers->links() }}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () { $('[data-toggle="tooltip"]').tooltip() })

    $('#customerSearch').on('keyup', function () {
        const q = $(this).val().toLowerCase();
        $('#customerTable tr').each(function () {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(q));
        });
    });

    function performDestroy(id, reference){
        confirmDestroy('/cms/admin/customers/' + id, reference);
    }
</script>
@endsection
