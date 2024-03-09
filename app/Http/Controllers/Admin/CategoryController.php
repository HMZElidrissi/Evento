<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:categories']
        ]);
        $category = Category::create($attributes);
        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255']
        ]);
        $category->update($attributes);
        return response()->json($category, 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
