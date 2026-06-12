<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private string $cartKey = 'cart';

    public function index()
    {
        $cart = session($this->cartKey, []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        $total = collect($cart)->sum(fn($item) => $item['subtotal']);

        return view('shop.checkout', compact('cart', 'total'));
    }

    public function store(CheckoutRequest $request)
    {
        $cart = session($this->cartKey, []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        $total = collect($cart)->sum(fn($item) => $item['subtotal']);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'buyer_name'     => $request->buyer_name,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'payment_method' => $request->payment_method,
                'total_price'    => $total,
                'status'         => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['subtotal'],
                ]);
            }

            session()->forget($this->cartKey);
            DB::commit();

            return redirect()->route('checkout.success', $order->id);

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function success(Order $order)
    {
        return view('shop.success', compact('order'));
    }
}
