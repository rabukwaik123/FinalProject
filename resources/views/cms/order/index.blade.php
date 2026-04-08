@extends('cms.parent')

@section('title','Orders')
@section('main-title','Orders')
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

  .table-hover tbody tr:hover{ background: var(--soft-hover); }

  .order-info{ font-weight: 600; color: #111; }

  .action-btn{
    width: 34px; height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    border: 1px solid transparent;
  }

  .action-show{ background: rgba(108,117,125,.12); }
  .action-edit{ background: rgba(201,124,157,.16); }
  .action-delete{ background: rgba(230,81,81,.12); }

  .actions-group{
    display: inline-flex;
    gap: 8px;
    justify-content: center;
  }

  .badge-warning{ background:#ffc107; }
  .badge-success{ background:#28a745; }
  .badge-danger{ background:#dc3545; }

  .order-badge{
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

        <h3 class="card-title mb-0">Orders</h3>

        <div class="d-flex align-items-center" style="gap:10px;">
          <div class="input-group input-group-sm" style="width: 240px;">
            <input id="orderSearch" type="text" class="form-control" placeholder="Search order...">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
          </div>

          <a href="{{ route('cms.orders.create') }}" class="btn btn-glow-pink btn-sm">
            <i class="fas fa-plus"></i> Add new order
          </a>
        </div>

      </div>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">

        <table class="table table-hover table-striped mb-0">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Customer</th>
              <th>Status</th>
              <th>Total</th>
              <th class="text-center">Created At</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>

          <tbody id="orderTable">
            @forelse($orders as $order)
              <tr>

                <td class="text-center text-muted">{{ $order->id }}</td>

                <td>
                  <span class="order-info">
                    {{ $order->customer->email ?? 'N/A' }}
                  </span>
                </td>

                <td>
                  <span class="badge
                    @if($order->order_status == 'pending') badge-warning
                    @elseif($order->order_status == 'completed') badge-success
                    @else badge-danger
                    @endif">
                    {{ ucfirst($order->order_status) }}
                  </span>
                </td>

                <td>
                  ${{ number_format($order->total_amount, 2) }}
                </td>

                <td class="text-center">
                  <span class="order-badge">
                    {{ $order->created_at->format('Y-m-d') }}
                  </span>
                </td>

                <td class="text-center">
                  <div class="actions-group">

                    <a href="{{ route('cms.orders.show', $order->id) }}" class="action-btn action-show">
                      <i class="fas fa-eye"></i>
                    </a>

                    <a href="{{ route('cms.orders.edit', $order->id) }}" class="action-btn action-edit">
                      <i class="fas fa-pen"></i>
                    </a>

                    <form action="{{ route('cms.orders.destroy', $order->id) }}" method="POST">
                      @csrf
                      @method('DELETE')

                      <button type="button"
                              onclick="performDestroy({{ $order->id }}, this)"
                              class="action-btn action-delete">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>

                  </div>
                </td>

              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted p-4">No orders found</td>
              </tr>
            @endforelse
          </tbody>

        </table>
      </div>
    </div>

    <div class="card-footer d-flex align-items-center flex-wrap" style="gap:10px;">
      <small class="text-muted">
        Total Revenue: ${{ number_format($totalAmount, 2) }} orders
      </small>

      <div class="ml-auto">
        {{ $orders->links() }}
      </div>
    </div>

  </div>

</div>
@endsection

@section('scripts')
<script>
    $(function () { $('[data-toggle="tooltip"]').tooltip() })

    $('#orderSearch').on('keyup', function () {
        const q = $(this).val().toLowerCase();
        $('#orderTable tr').each(function () {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(q));
        });
    });

    function performDestroy(id, reference){
        confirmDestroy('/cms/admin/orders/' + id, reference);
    }
</script>
@endsection
