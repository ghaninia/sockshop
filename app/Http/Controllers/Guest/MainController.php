<?php

namespace App\Http\Controllers\Guest ;

use App\Helpers\Attachments\PublicDiskAttachment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        return view('guest.main');
    }

    public function store(Request $request , PublicDiskAttachment $attachment )
    {
        return $attachment->upload("test" , "pic");
    }
}
