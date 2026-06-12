<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    public function rules(): array
    {
        $imageRules = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];

        // Saat create, image tidak wajib; saat update juga tidak wajib
        return [
            'name'        => ['required', 'string', 'max:100'],
            'price'       => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string', 'max:2000'],
            'category'    => ['nullable', 'string', 'max:50'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'image'       => $imageRules,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.min'      => 'Harga minimal Rp 1.',
            'image.image'    => 'File harus berupa gambar.',
            'image.mimes'    => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max'      => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
