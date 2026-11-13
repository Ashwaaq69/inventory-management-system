<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Temporary product list. Day 3 replaces this with the database.
     */
    private function products(): array
    {
        return [
            ['id' => 1, 'name' => 'USB Cable', 'sku' => 'USB-001', 'quantity' => 40],
            ['id' => 2, 'name' => 'Keyboard', 'sku' => 'KEY-010', 'quantity' => 12],
            ['id' => 3, 'name' => 'Mouse', 'sku' => 'MOU-004', 'quantity' => 25],
        ];
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->products(),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $product = collect($this->products())->firstWhere('id', $id);

        if (! $product) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }

        return response()->json([
            'data' => $product,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Product received. It will be saved to the database on Day 3.',
            'data' => [
                'id' => 4,
                'name' => $request->input('name'),
                'sku' => $request->input('sku'),
                'quantity' => (int) $request->input('quantity', 0),
            ],
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json([
            'message' => 'Product update received. It will be saved to the database on Day 3.',
            'data' => [
                'id' => $id,
                'name' => $request->input('name'),
                'sku' => $request->input('sku'),
                'quantity' => (int) $request->input('quantity', 0),
            ],
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json([
            'message' => "Product {$id} would be removed. Deleting from the database comes on Day 3.",
        ]);
    }
}
