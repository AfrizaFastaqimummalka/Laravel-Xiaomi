@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Detail Pesanan <span class="text-muted">#{{ $order->id }}</span></h5>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-4">
    {{-- Order Info --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 pb-2 border-bottom">
                    <i class="bi bi-person-lines-fill me-2" style="color:#FF6900"></i>Informasi Pembeli
                </h6>
                <table class="table table-borderless mb-0 small">
                    <tr>
                        <td class="text-muted ps-0" style="width:40%">Nama</td>
                        <td class="fw-semibold">{{ $order->buyer_name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Telepon</td>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Alamat</td>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Pembayaran</td>
                        <td class="text-capitalize fw-semibold">{{ $order->payment_method }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Tanggal</td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted ps-0">Status</td>
                        <td>
                            <span class="badge badge-{{ $order->status }} px-3 py-2 rounded-pill">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 pb-2 border-bottom">
                    <i class="bi bi-arrow-repeat me-2" style="color:#FF6900"></i>Update Status
                </h6>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            @foreach(['pending' => 'Pending', 'processing' => 'Diproses', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                                <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn w-100 fw-semibold"
                            style="background:#FF6900;color:#fff;border:none">
                        <i class="bi bi-save me-2"></i>Simpan Status
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Order Items --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 pb-2 border-bottom">
                    <i class="bi bi-cart-check me-2" style="color:#FF6900"></i>Item Pesanan
                </h6>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead style="background:#f8f9fa">
                            <tr>
                                <th class="py-2">Produk</th>
                                <th class="py-2 text-center">Harga</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($item->product && $item->product->image && \Storage::disk('public')->exists($item->product->image))
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}"
                                                     class="rounded-2" style="width:44px;height:44px;object-fit:cover">
                                            @else
                                                <div class="rounded-2 d-flex align-items-center justify-content-center"
                                                     style="width:44px;height:44px;background:#f8f9fa">
                                                    <i class="bi bi-phone text-muted small"></i>
                                                </div>
                                            @endif
                                            <span class="fw-semibold small">{{ $item->product_name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted small">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">× {{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-end fw-bold" style="color:#FF6900">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot style="background:#f8f9fa">
                            <tr>
                                <td colspan="3" class="text-end fw-bold py-3">Total Pembayaran</td>
                                <td class="text-end fw-bold fs-5 py-3" style="color:#FF6900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
