<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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

        $products = Product::get();
        return Inertia::render('Private/ProductList', [
            'products' => $products
        ]);
    }

    public function show($id = null)
    {
        $products = [];
        if ($id) {
            $products = Product::where('id', $id)->get();
        }

        return Inertia::render('Private/AddProduct', [
            'products' => $products
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);
            $data['created_by'] = auth()->user()->id;

            $product = Product::create(Arr::except($data, ['images']));
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = $this->uploadOne($image, 'product');
                    Media::create([
                        'filename' => $filename,
                        'product_id' => $product->id
                    ]);
                }
            }
            return to_route('product.add')->with('notification', [
                'color' => 'green',
                'title' => 'success',
                'message' => 'category added successfully!',
            ]);
        } catch (\Exception $e) {
            return to_route('product.add')->with('notification', [
                'color' => 'red',
                'title' => 'error',
                'message' => $e,
            ]);
        }
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}