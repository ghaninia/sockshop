<?php

namespace App\Http\Controllers\Guest ;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use Faker\Generator as Faker;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        return view('guest.main');
    }

    public function store(Request $request , Faker $faker )
    {
       
    }
}
