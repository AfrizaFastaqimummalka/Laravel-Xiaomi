@extends('layouts.admin')

@section('title', 'Manajemen Transaksi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Transaksi</h5>
        <small class="text-muted">{{ $orders->total() }} total transaksi</small>
    </div>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm rounded-3 mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold mb-1">Cari Pembeli</label>
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Nama atau telepon..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold mb-1">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(['pending' => 'Pending', 'processing' => 'Diproses', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                        <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-sm btn-dark w-100">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
            </div>
            @if(request()->anyFilled(['search','status']))
                <div class="col-md-2">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary w-100">Reset</a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        @if($orders->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-receipt" style="font-size:3rem;color:#ddd"></i>
                <p class="mt-3">Belum ada pesanan.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa">
                        <tr>
                            <th class="px-4 py-3">#ID</th>
                            <th class="py-3">Pembeli</th>
                            <th class="py-3">Telepon</th>
                            <th class="py-3">Items</th>
                            <th class="py-3">Total</th>
                            <th class="py-3">Pembayaran</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 fw-bold text-muted">#{{ $order->id }}</td>
                                <td class="fw-semibold">{{ $order->buyer_name }}</td>
                                <td class="text-muted small">{{ $order->phone }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $order->items->count() }} item
                                    </span>
                                </td>
                                <td class="fw-bold" style="color:#FF6900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="text-capitalize small">{{ $order->payment_method }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status }} px-3 py-2 rounded-pill">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
