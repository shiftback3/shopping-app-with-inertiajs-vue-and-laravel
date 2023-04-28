<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['images'])->get();
        return Inertia::render('Public/Index', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->with(['images'])->get();
        return Inertia::render('Public/ProductDetails', [
            'product' => $product
        ]);
    }
}
