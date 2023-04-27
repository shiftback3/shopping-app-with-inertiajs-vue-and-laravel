<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::get();
        return Inertia::render('Private/CategoryList', [
            'categories' => $categories
        ]);
    }

    public function show($id = null)
    {
        $categories = [];
        if ($id) {
            $categories = Category::where('id', $id)->get();
        }

        return Inertia::render('Private/AddCategory', [
            'category' => $categories
        ]);
    }

    public function store(CategoryRequest $request)
    {
        // return $request;
        $data = $request->validated();
        // return $data;

        $data['slug'] = Str::slug($data['title']);

        Category::create($data);

        return to_route('category.add')->with('notification', [
            'color' => 'green',
            'title' => 'success',
            'message' => 'category added successfully!',
        ]);
    }

    public function update(CategoryRequest $request, Category $id)
    {
        // return $id;
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);


        $id->update($data);
        return to_route('category.edit')->with('notification', [
            'color' => 'green',
            'title' => 'success',
            'message' => 'category updated successfully!',
        ]);
    }

    public function destroy($id)
    {

        $data = Category::find($id);

        // return $data;
        if ($data) {
            $data->delete();
            return to_route('category.index')->with('notification', [
                'color' => 'green',
                'title' => 'success',
                'message' => 'category deleted successfully!',
            ]);
        }
    }
}