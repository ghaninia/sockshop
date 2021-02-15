<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Question extends Component
{
    public $questions ;
    public function __construct()
    {
        $this->questions = [
            // [
            //     "title" => "" ,
            //     "description" => ""
            // ],
        ] ;
    }
    public function render()
    {
        return view('components.question');
    }
}
