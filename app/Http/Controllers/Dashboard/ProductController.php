<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Attachments\PublicDiskAttachment;
use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;
use App\Models\File;
use App\Models\Order;
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

    public function index(Request $request)
    {
        $this->seo([
            "title" => "لیست محصولات"
        ]);
        $s = $request->input("s");
        $products = Product::when($s, function ($query) use ($s) {
            return $query->where("title", "like", "%{$s}%");
        })
            ->withCount([
                "orders" => function ($query) {
                    return $query->where("status", Order::STATUS_SUCCEED);
                },
            ])
            ->paginate(12);
        return view("dashboard.product.index", compact("products"));
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

        $product->categories()->sync($request->input("categories", []));
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

    public function edit(Product $product)
    {
        $this->seo([
            "title" => [
                "ویرایش محصول",
                $product->title
            ]
        ]);
        $variances =
            $product->variances()->select([
                "id",
                "title",
                "tooltip",
                "price"
            ])->get();
        $categories = $this->categories->all();
        $productCategories = $product->categories->pluck("id")->toArray();
        $keywords = implode(",", $product->keywords);
        return view("dashboard.product.edit", compact("product", "variances", "categories", "keywords", "productCategories"));
    }

    public function update(ProductUpdate $request, Product $product, PublicDiskAttachment $attachment)
    {

        $product->update([
            "keywords" => $request->input("keywords", []),
            "title" => $request->input("title"),
            "slug" => slug($request->input("title")),
            "summary" => $request->input("summary"),
            "description" => $request->input("description"),
        ]);
        $product->categories()->sync($request->input("categories", []));


        if ($request->has("picture"))
            File::upload($product, "picture", "picture");

        $galleries = $request->file("galleries");
        //delete different
        if ($request->has("previous_galleries")) {
            $galleriesOldest = json_decode(json_encode(gallery($product)));
            $previosGalleries = $request->input("previous_galleries");
            $diff = array_diff($galleriesOldest, $previosGalleries);
            if (count($diff))
                foreach ($diff as $item) {
                    $product->files()->where("files.url", "like", "%" . basename($item))->delete();
                }
        }else{
            $product->files()->where("usage" , "gallery")->delete() ;
        }

        $complationGalleries = [];
        if (is_array($galleries)) {
            for ($i = 0; $i < count($galleries); $i++) {
                $complationGalleries[] = $attachment->upload("galleries.$i", "gallery");
            }
            $complationGalleries =  collect($complationGalleries)->collapse();
            if (count($complationGalleries))
                $product->files()->createMany($complationGalleries);
        }

        $variances = $request->input("variances") ?? [];
        $oldestVariances = $product->variances()->pluck("id")->toArray();
        $diff = array_diff($oldestVariances, array_keys($variances));
        $product->variances()->whereIn("id", $diff)->delete();
        foreach ($variances as $key => $variance) {
            if (!in_array($key, $oldestVariances)) {
                $product->variances()->create($variance);
            }
            $product->variances()->where("id", $key)->update($variance);
        }

        return $this->success("محصول شما با موفقیت ویرایش گردید.");
    }

    public function destroy(Product $product)
    {
        $product->files->each->delete();
        $product->orders()->delete();
        $product->categories()->detach();
        $product->delete();
        return $this->success("محصول با موفقیت حذف گردیده است.");
    }
}
