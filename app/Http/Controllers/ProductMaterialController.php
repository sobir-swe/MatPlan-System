<?php

namespace App\Http\Controllers;

use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => ProductMaterial::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'material_id' => 'required|exists:materials,id',
        ]);

        $product_materials = ProductMaterial::query()->create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $product_materials
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $product_material = ProductMaterial::query()->find($id);

        if (!$product_material) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product material not found!'
            ], 404);
        }
        return response()->json([
            'message' => 'Get product material successfully!',
            'status' => 'success',
            'data' => $product_material
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $product_material = ProductMaterial::query()->find($id);
        if(!$product_material) {
            return response()->json([
                'message' => 'Product material not found!',
                'status' => 'error',
            ], 404);
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'material_id' => 'required|exists:materials,id',
        ]);

        $product_material->update($validated);
        return response()->json([
            'message' => 'Update product material successfully!',
            'status' => 'success',
            'data' => $product_material
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $product_material = ProductMaterial::query()->find($id);
        if(!$product_material) {
            return response()->json([
                'message' => 'Product material not found!',
                'status' => 'error',
            ], 404);
        }
        $product_material->delete();
        return response()->json([
            'message' => 'Delete product material successfully!',
            'status' => 'success',
        ]);
    }
}
