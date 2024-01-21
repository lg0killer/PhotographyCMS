<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return inertia('Admin/Category/Index', ['categories' => $categories]);
    }

    public function create() {
        return inertia('Admin/Category/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required | unique:categories,name',
            'description' => 'required',
            'short_code' => 'required | unique:categories,short_code'
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category.index')->banner('Category created successfully.');
    }

    public function edit(Category $category) {
        return inertia('Admin/Category/Edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required | unique:categories,name,' . $category->id,
            'description' => 'required',
            'short_code' => 'required | unique:categories,short_code,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('admin.category.index')->banner('Category updated successfully.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admin.category.index')->banner('Category deleted successfully.');
    }
}
