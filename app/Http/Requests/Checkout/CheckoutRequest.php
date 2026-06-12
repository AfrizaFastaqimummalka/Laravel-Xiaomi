<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'buyer_name'     => ['required', 'string', 'max:100'],
            'phone'          => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'address'        => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'in:transfer,cod,ewallet'],
        ];
    }

    public function messages(): array
    {
        return [
            'buyer_name.required'     => 'Nama pembeli wajib diisi.',
            'phone.required'          => 'Nomor telepon wajib diisi.',
            'phone.regex'             => 'Format nomor telepon tidak valid.',
            'address.required'        => 'Alamat pengiriman wajib diisi.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
            'payment_method.in'       => 'Metode pembayaran tidak valid.',
        ];
    }
}
