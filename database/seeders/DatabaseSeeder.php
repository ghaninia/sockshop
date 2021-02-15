<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Option;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Admin::create([
            'status' => true,
            'fullname' => "محمدامین",
            'email' => "info@ghaninia.ir",
            'password' => bcrypt("secret"),
        ]);
        Option::insert([
            [
                "key"     => "title",
                "value"   => NULL,
                "default" => "پا بده",
            ],
            [
                "key"     => "shop_title",
                "value"   => NULL,
                "default" => "درگاه خرید جوراب",
            ],
            [
                "key"     => "description",
                "value"   => NULL,
                "default" => "فروشگاه جوراب پا بده",
            ],
            [
                "key"     => "keywords",
                "value"   => NULL,
                "default" => "پابده,جوراب بخر,جوراب بگیر,فروشگاه جوراب",
            ],
            [
                "key"     => "copyright",
                "value"   => NULL,
                "default" => "تمام حقوق این وبسایت متعلق به پابده است",
            ],
            [
                "key"     => "support_mobile",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "support_phone",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "support_email",
                "value"   => NULL,
                "default" => "info@pabede.ir",
            ],
            [
                "key"     => "shop_description",
                "value"   => NULL,
                "default" => "فروشگاه پا بده فروشگاه اینترنتی فروش جوراب بصورت عمده",
            ],
            [
                "key"     => "logo",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "favicon",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "support_facebook",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "support_twitter",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "support_instagram",
                "value"   => NULL,
                "default" => NULL,
            ],
            [
                "key"     => "support_telegram",
                "value"   => NULL,
                "default" => NULL,
            ],
        ]);
    }
}
