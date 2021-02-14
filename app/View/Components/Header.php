<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Header extends Component
{
    public $routeName  ;
    public function __construct()
    {
        $this->routeName = Route::currentRouteName() ;
    }

    public function render()
    {
        return view('components.header');
    }
}
