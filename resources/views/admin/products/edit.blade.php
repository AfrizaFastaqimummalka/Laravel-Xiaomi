@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Produk</h5>
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.products.update', $product) }}"
                      enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-semibold">Rp</span>
                            <input type="number" name="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price) }}" min="1" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Supplier</label>
                        <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ (string) old('supplier_id', $product->supplier_id) === (string) $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Produk</label>

                        {{-- Current Image --}}
                        @if($product->image && \Storage::disk('public')->exists($product->image))
                            <div class="mb-2">
                                <p class="text-muted small mb-1">Gambar saat ini:</p>
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                     class="rounded-2" style="max-height:160px;max-width:260px;object-fit:cover">
                            </div>
                        @endif

                        <input type="file" name="image" id="imageInput"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               onchange="previewImage(this)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Maks 2MB.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div id="imagePreview" class="mt-2 d-none">
                            <p class="text-muted small mb-1">Preview gambar baru:</p>
                            <img id="previewImg" src="" alt="Preview"
                                 class="rounded-2" style="max-height:160px;max-width:260px;object-fit:cover">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn fw-semibold px-4"
                                style="background:#FF6900;color:#fff;border:none">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection
