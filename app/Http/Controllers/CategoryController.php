<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //index
    public function index() {
         $categories = \App\Models\Category::paginate(5);
    return view('pages.category.index', compact('categories'));
    }

    //create
    public function create() {
        return view('pages.category.create');
    }

    //store
    public function store(Request $request) {
        \App\Models\Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category Recorded');
    }

    //edit
    public function edit($id) {
        $category = \App\Models\Category::find($id);
        return view('pages.category.edit', compact('category'));
    }

    //update
    public function update(Request $request, $id) {
        $category = \App\Models\Category::find($id);
        $category->update($request->all());
        return redirect()->route('category.index')->with('success', 'Success Update Category');
    }

    //destroy
    public function destroy($id) {
        $category = \App\Models\Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Success Delete Category');
    }
}
