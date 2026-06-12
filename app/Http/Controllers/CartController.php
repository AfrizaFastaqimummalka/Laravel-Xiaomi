<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private string $cartKey = 'cart';

    public function index()
    {
        $cart  = session($this->cartKey, []);
        $total = collect($cart)->sum(fn($item) => $item['subtotal']);

        return view('shop.cart', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $qty  = (int) $request->quantity;
        $cart = session($this->cartKey, []);
        $key  = (string) $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $qty;
            $cart[$key]['subtotal']  = $cart[$key]['price'] * $cart[$key]['quantity'];
        } else {
            $cart[$key] = [
                'product_id'   => $product->id,
                'product_name' => $product->name,
                'price'        => $product->price,
                'image'        => $product->image_url,
                'quantity'     => $qty,
                'subtotal'     => $product->price * $qty,
            ];
        }

        session([$this->cartKey => $cart]);

        return redirect()->route('cart.index')
            ->with('success', "{$product->name} berhasil ditambahkan ke keranjang.");
    }

    public function update(Request $request, string $productId)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $cart = session($this->cartKey, []);

        if (isset($cart[$productId])) {
            $qty                          = (int) $request->quantity;
            $cart[$productId]['quantity'] = $qty;
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $qty;
            session([$this->cartKey => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    public function remove(string $productId)
    {
        $cart = session($this->cartKey, []);
        unset($cart[$productId]);
        session([$this->cartKey => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget($this->cartKey);
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }
}
