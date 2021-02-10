<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Attachments\Attachment;
use App\Helpers\Attachments\PublicDiskAttachment;
use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStore;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Response;
    public $products, $categories;
    public function __construct(ProductRepository $products, CategoryRepository $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    public function index()
    {
        
    }

    public function create()
    {
        $this->seo([
            "title" => "محصول جدید"
        ]);

        $categories = $this->categories->all();
        return view("dashboard.product.create", compact("categories"));
    }

    public function store(ProductStore $request, PublicDiskAttachment $attachment)
    {
        $galleries  = $request->file("galleries");
        $product = $this->products->create([
            "keywords" => $request->input("keywords", []),
            "title" => $request->input("title"),
            "slug" => slug($request->input("title")),
            "summary" => $request->input("summary"),
            "description" => $request->input("description"),
        ]);

        $product->categories()->sync($request->input("categories"));
        $product->variances()->createMany($request->input("variances"));

        if ($request->has("picture"))
            File::upload($product, "picture", "picture");

        $RQgalleries = [];
        if (is_array($galleries))
            for ($i = 0; $i < count($galleries); $i++)
                $RQgalleries[] = $attachment->upload("galleries.$i", "gallery");

        if (count($RQgalleries))
            $product->files()->createMany(collect($RQgalleries)->collapse());

        return $this->success("محصول با موفقیت ثبت گردیده است.");
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
