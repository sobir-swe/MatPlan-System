<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => Material::all(),
            'status' => 'success',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $material = Material::query()->create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $material
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $material = Material::query()->findOrFail($id);

        if (!$material) {
            return response()->json([
                'data' => 'Material not found!',
                'status' => 'error',
            ], 404);
        }

        return response()->json([
            'message' => 'Get material successfully!',
            'status' => 'success',
            'data' => $material
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $material = Material::query()->findOrFail($id);

        if (!$material) {
            return response()->json([
                'data' => 'Material not found!',
                'status' => 'error',
            ], 404);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:materials'
        ]);

        $material->update([$validated]);

        return response()->json([
            'message' => 'Material updated successfully!',
            'status' => 'success',
            'data' => $material
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $material = Material::query()->findOrFail($id);
        if (!$material) {
            return response()->json([
                'data' => 'Material not found!',
                'status' => 'error',
            ], 404);
        }

        $material->delete();
        return response()->json([
            'message' => 'Material deleted successfully!',
            'status' => 'success',
        ]);
    }
}
