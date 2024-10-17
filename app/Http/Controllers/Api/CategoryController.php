<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Category::all());

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
            'name' => 'required|string|max:255',
        ]);

        $category =  Category::create([
            'name'=> $request->name,
            'parrent_id'=> $request->parrent_id
        ]);

       return response()->json($category);
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Category::query()->findOrFail($id));
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
    public function update(Request $request, Category $category)
    {
        // Kiritish jarayonida
            $request->validate([
            'name' => 'required|string|max:255',
            // boshqa validatsiyalar
        ]);

        $updated = $category->update([
            'name'      => $request->name,
            'parent_id' => $request->parent_id
        ]);

        if ($updated) {
            return response()->json(['name' => $category->name]);
        }
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\Response
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();

        return response()->noContent();
    }


}
