@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#fff0e6">
                    <i class="bi bi-box-seam" style="color:#FF6900"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Produk</div>
                    <div class="fw-bold fs-3">{{ number_format($totalProducts) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#e8f4fd">
                    <i class="bi bi-receipt" style="color:#0d6efd"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fw-bold fs-3">{{ number_format($totalOrders) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#e8f8ee">
                    <i class="bi bi-currency-dollar" style="color:#198754"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pendapatan</div>
                    <div class="fw-bold" style="font-size:1.2rem">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#fff8e1">
                    <i class="bi bi-clock-history" style="color:#ffc107"></i>
                </div>
                <div>
                    <div class="text-muted small">Menunggu Konfirmasi</div>
                    <div class="fw-bold fs-3">{{ number_format($pendingOrders) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Orders Table --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Pesanan Terbaru</h6>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        @if($recentOrders->isEmpty())
            <div class="text-center py-4 text-muted">
                <i class="bi bi-inbox" style="font-size:2rem"></i>
                <p class="mt-2 mb-0">Belum ada pesanan</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Pembeli</th>
                            <th>Telepon</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentOrders as $order)
                            <tr>
                                <td class="fw-bold text-muted">#{{ $order->id }}</td>
                                <td class="fw-semibold">{{ $order->buyer_name }}</td>
                                <td class="text-muted small">{{ $order->phone }}</td>
                                <td class="fw-bold" style="color:#FF6900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="text-capitalize small">{{ $order->payment_method }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status }} px-3 py-2">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                                <td>
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
        @endif
    </div>
</div>

@endsection
