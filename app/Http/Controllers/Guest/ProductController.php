<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $category =  $product->categories()->first();
        $this->seo([
            "title" => $product->title,
            "description" => $product->description,
            "article" => [
                "created_at" => $product->created_at,
                "category" => $category->name,
                "cover" => picture($product, true, 'picture', 'full'),
            ],
            "keywords" => $product->keywords
        ]);

        $redirect = sprintf("%s#%s" , route('guest.main') ,  $product->slug );

        return view('guest.product', compact('redirect', 'product'));
    }
}
