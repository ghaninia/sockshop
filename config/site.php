<?php
return [
    "title" => "پا بده !",
    "description" => "خرید انواع و اقسام جوراب های مردانه ، زنانه و بچه گانه",
    "keywords" => [
        "پابده",
        "jorab",
        "جوراب",
        "socks",
        "sock"
    ],
    "preview" => "assets/dashboard/images/preview.svg",
    "gender" => [
        "male" => "assets/dashboard/images/gender/male.svg",
        "female" => "assets/dashboard/images/gender/female.svg",
    ] ,
    "regex" => [
        "tellphone" => [
            "front" => "0[0-9]{10}",
            "back" => "/^0[0-9]{10}$/" ,
            "label" => "باید همراه با کد شهر وارد نمایید، برای مثال 01132111111"
        ] ,
        "mobile" => [
            "front" => "09[0-9]{9}",
            "back"  => "/^09[0-9]{9}$/"
        ],
        "postal" => [
            "front" => "[0-9]{10}$",
            "back" => "/^[0-9]{10}$/",
            "label" => "کدپستی از قاعده پیروی نمی‌کند."
        ],
        "persian" => [
            "front" => "[\u0600-\u06FF ]+",
            "back"  => "/[^x{600}-\x{6FF} $]/u",
            "label" => "از قاعده زبان فارسی پیروی نمی‌کند."
        ],
    ],
    "notification" => "09114904505" ,
    "address" => 200 // address length
];
