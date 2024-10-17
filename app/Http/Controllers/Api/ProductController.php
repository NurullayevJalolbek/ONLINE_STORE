<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return Product::query()
            ->when($request->category_id, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->when($request->order, function ($query) use ($request) {
                return $query->orderBy("id", $request->order);
            })
            ->limit($request->limit)
            ->get();
//        return response()->json([
//            Product::all()
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category_id' => $request->category_id,
        ]);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        // Mahsulotni topish va uni qaytarish
        $product = Product::query()->findOrFail($id);

        return response()->json($product, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name'        => 'sometimes|required',
            'description' => 'sometimes|required',
            'price'       => 'sometimes|required|numeric',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $product->update($request->only(['name', 'description', 'price', 'category_id']));

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        $product->delete();

        return response()->json([], 204);
    }

    public function getCategoryProducts($id): ProductCollection
    {
        $product = Product::query()->where('category_id', $id)
            ->with("category")
            ->paginate();
        return new ProductCollection($product);

    }

}
