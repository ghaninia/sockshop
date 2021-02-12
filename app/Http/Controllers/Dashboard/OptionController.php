<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Attachments\PublicDiskAttachment;
use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionStore;
use App\Models\Option;

class OptionController extends Controller
{
    use Response;
    public function index()
    {
        $this->seo([
            "title" => "تنظیمات",
        ]);
        return view("dashboard.option.index");
    }

    public function store(OptionStore $request, PublicDiskAttachment $storage)
    {
        Option::put("title", $request->input("title"));
        Option::put("description", $request->input("description"));
        Option::put("copyright", $request->input("copyright"));
        Option::put("support_mobile", $request->input("support_mobile"));
        Option::put("support_phone", $request->input("support_phone"));
        Option::put("support_email", $request->input("support_email"));
        Option::put("shop_description", $request->input("shop_description"));
        Option::put("shop_title", $request->input("shop_title"));
        Option::put("keywords", implode(",", $request->input("keywords", [])));
        if ($request->has("logo")) {
            $logo = $storage->upload("logo", "logo");
            Option::put("logo", json_encode($logo));
        }
        if ($request->has("favicon")) {
            $favicon = $storage->upload("favicon", "favicon");
            Option::put("favicon", json_encode($favicon));
        }
        Option::generate();
        return $this->success("تنظیمات با موفقیت ویرایش گردیده است.");
    }
}
