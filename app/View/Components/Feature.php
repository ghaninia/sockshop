<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Feature extends Component
{
    public array $features;

    public function __construct()
    {
        $this->features = [
            [
                "icon" => "feather-truck",
                "title" => "ارسال سریع و رایگان",
                "description" => "خریدهای به صورت رایگان و در سریع ترین زمان ارسال می شود.",
            ],
            [
                "icon" => "feather-award",
                "title" => "ضمانت اصالت کالا",
                "description" => "تمامی کالاها به صورت اورجینال و با ضمانت اصل بودن ارائه می شود.",
            ],
            [
                "icon" => "feather-shopping-bag",
                "title" => "تنوع محصولات",
                "description" => "خرید از 300 برند بین المللی و ایرانی در هر ساعت شبانه روز و در هر نقطه از کشور برای شما فراهم شده است.",
            ],
            [
                "icon" => "feather-trending-up",
                "title" => "تعویض رایگان و مرجوع",
                "description" => "با خیال راحت میتوانید در صورت عدم رضایت، کالای خریداری شده را تعویض یا مرجوع نمایید.",
            ],
        ];
    }

    public function render()
    {
        return view('components.feature');
    }
}
