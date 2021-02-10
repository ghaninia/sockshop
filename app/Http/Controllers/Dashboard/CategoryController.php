<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStore;
use App\Models\Category;
use App\Models\File;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Response;
    private $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->seo([
            "title" => "دسته بندی",
        ]);
        $this->categories = $categories;
    }

    public function index(Request $request)
    {
        $s = $request->input("s");
        $categories = Category::when($s, function ($query) use ($s) {
            return $query->where("name", "like", "%{$s}%");
        })->paginate(12);
        return view("dashboard.category.index", compact("categories"));
    }

    public function store(CategoryStore $request)
    {
        $category = $this->categories->create([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "slug" => slug($request->input("name"))
        ]);
        File::upload($category, "picture", "picture");
        return $this->success("دسته بندی با موفقیت ساخته شد.");
    }

    public function destroy(Category $category)
    {
        $category->products()->detach();
        $category->files()->delete();
        $category->delete();
        return $this->success("دسته بندی با موفقیت حذف گردید.");
    }
}
