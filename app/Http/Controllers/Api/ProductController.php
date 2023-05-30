<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function products() 
    {
        $products = Product::all();

        return response()->json($products);
    }

    public function show($pid)
    {
        $product = Product::find($pid);

        return response()->json($product);
    }

    public function search($query)
    {
        $products = Product::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($query) . '%'])
            ->get();

        return response()->json($products);
    }
}
