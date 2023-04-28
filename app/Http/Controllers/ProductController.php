<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class ProductController extends Controller
{
    use UploadAble;
    public function index()
    {
        $categories = Category::get();
        $products = Product::with(['images'])->get();
        return Inertia::render('Private/ProductList', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function show($id = null)
    {
        $categories = Category::get();
        $products = [];
        if ($id) {
            $products = Product::where('id', $id)->with(['images'])->get();
        }

        return Inertia::render('Private/AddProduct', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function store(ProductRequest $request)
    {
        // return $request->file('images');
            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);
            $data['created_by'] = auth()->user()->id;

            $product = Product::create(Arr::except($data, ['images']));
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = $this->uploadOne($image, 'product');
                    Media::create([
                        'filename' => $filename,
                    'filetype' => 'image',
                    'product_id' => $product->id,
                    ]);
                }
            }
            return to_route('product.add')->with('notification', [
                'color' => 'green',
                'title' => 'success',
            'message' => 'product added successfully!',
            ]);
    }

    public function update(ProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $product->update($data);

        if ($request->hasFile('images')) {
            // Clean up
            $images = Media::where('product_id', $id)->get(['id', 'filename']);

            foreach ($images as $image) {
                $filename = $this->deleteOne($image['filename']);
            }
            $images = $images->pluck('id');
            Media::destroy($images->toArray());

            foreach ($request->file('images') as $image) {
                $filename = $this->uploadOne($image, 'product');
                Media::create([
                    'filename' => $filename,
                    'product_id' => $product->id,
                    'filetype' => 'image',
                ]);
            }
        }

        return to_route('product.add')->with('notification', [
            'color' => 'green',
            'title' => 'success',
            'message' => 'product updated successfully!',
        ]);

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Clean up
        $images = Media::where('product_id', $id)->get(['id', 'filename']);

        foreach ($images as $image) {
            $filename = $this->deleteOne($image['filename']);
        }
        $images = $images->pluck('id');
        Media::destroy($images->toArray());
        if ($product->delete()) {
            return to_route('product.index')->with('notification', [
                'color' => 'green',
                'title' => 'success',
                'message' => 'product deleted successfully!',
            ]);
        } else {
            return to_route('product.index')->with('notification', [
                'color' => 'red',
                'title' => 'error',
                'message' => 'aomething went wrong!',
            ]);
        }
    }
}