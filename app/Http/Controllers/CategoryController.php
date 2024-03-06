<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255']
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
