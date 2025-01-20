<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index() : View
    {
        //mendapatkan semua products
        $products = Product::latest()->paginate(5);

        //rendering view dengan products
        return view('product.index', compact('products'));
    }

}
