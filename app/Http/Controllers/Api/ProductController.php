<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($data);
        return response()->json($product, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return response()->json(Product::findOrFail($id), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'  => 'sometimes|required|string',
            'price' => 'sometimes|required|integer|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product->update($data);
        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
