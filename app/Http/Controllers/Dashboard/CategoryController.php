<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categories;
    public function __construct(CategoryRepository $categories)
    {
        $this->seo([
            "title" => "دسته بندی" ,
        ]) ;
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->paginate();
        return view("dashboard.category.index", compact("categories"));
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
