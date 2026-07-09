<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductPublicController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        return view('product', compact('products'));
    }
    public function products(Request $request)
    {
        $category = $request->query('category');
        $products = Product::when($category, function($query, $category) {
            return $query->where('category', $category);
        })->get();

        return view('product', compact('products', 'category'));
    }
    
}
