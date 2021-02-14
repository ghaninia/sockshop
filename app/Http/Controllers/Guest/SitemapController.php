<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $products = Product::all();
        return response()->view('guest.sitemap', compact('products'))->header('Content-Type', 'text/xml');
    }
}
