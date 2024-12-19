<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products|string',
            'code' => 'required|max:255|unique:products|string',
        ]);

        $product = Product::query()->create([$validated]);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found!',
                'status' => 'error',
            ], 404);
        }

        return response()->json([
            'message' => 'Get product successfully!',
            'status' => 'success',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found!',
                'status' => 'error',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|max:255|string',
            'code' => 'required|max:255|string',
        ]);

        $product->update([$validated]);
        return response()->json([
            'message' => 'Product updated successfully!',
            'status' => 'success',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::query()->find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found!',
                'status' => 'error',
            ], 404);
        }

        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully!',
            'status' => 'success',
        ]);
    }
}
