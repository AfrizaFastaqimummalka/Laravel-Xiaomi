@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-0">Daftar Produk</h5>
        <small class="text-muted">{{ $products->total() }} produk terdaftar</small>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-sm fw-semibold"
       style="background:#FF6900;color:#fff;border:none">
        <i class="bi bi-plus-lg me-1"></i>Tambah Produk
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-0">
        @if($products->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-box-seam" style="font-size:3rem;color:#ddd"></i>
                <p class="mt-3">Belum ada produk. <a href="{{ route('admin.products.create') }}" style="color:#FF6900">Tambah sekarang</a></p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="py-3">Gambar</th>
                            <th class="py-3">Nama Produk</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3">Supplier</th>
                            <th class="py-3">Harga</th>
                            <th class="py-3">Dibuat</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="px-4 text-muted small">{{ $product->id }}</td>
                                <td>
                                    @if($product->image && \Storage::disk('public')->exists($product->image))
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                             class="rounded-2" style="width:52px;height:52px;object-fit:cover">
                                    @else
                                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                                             style="width:52px;height:52px;background:#f8f9fa">
                                            <i class="bi bi-phone text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $product->name }}</span>
                                    @if($product->description)
                                        <p class="text-muted small mb-0"
                                           style="max-width:260px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis">
                                            {{ $product->description }}
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge bg-light text-muted border">{{ $product->category }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $product->supplier?->name ?? '-' }}</td>
                                <td class="fw-bold" style="color:#FF6900">{{ $product->formatted_price }}</td>
                                <td class="text-muted small">{{ $product->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                              onsubmit="return confirm('Hapus produk ini? Tindakan tidak bisa dibatalkan.')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
