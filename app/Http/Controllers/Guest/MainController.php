<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $this->seo([

        ]) ;
        return view('guest.main');
    }

    public function store(Request $request)
    {
    }
}
