<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($product->stock < $data['quantity']) {
            return response()->json([
                'message' => 'Stok tidak mencukupi'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Hitung total harga
        $total = $data['quantity'] * $product->price;

        // Buat transaksi
        $transaction = Transaction::create([
            'product_id'  => $product->id,
            'quantity'    => $data['quantity'],
            'total_price' => $total,
        ]);

        // Kurangi stok
        $product->decrement('stock', $data['quantity']);

        return response()->json($transaction, Response::HTTP_CREATED);
    }
}
