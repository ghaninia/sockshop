<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        $this->seo([
            "title" => "تنظیمات" ,
        ]) ;
        return view("dashboard.option.index") ;
    }

    public function store(Request $request)
    {
    }
}
