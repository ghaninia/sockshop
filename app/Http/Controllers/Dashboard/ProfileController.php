<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePassword;
use App\Http\Requests\ProfileStore;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use Response ;
    public function index()
    {
        $admin = Auth::loginUsingId(1) ;
        $this->seo([
            "title" => "ویرایش پروفایل"
        ]) ;
        $user = me() ;
        return view("dashboard.profile.index" , compact("user")) ;
    }

    public function store(ProfileStore $request )
    {
        me()->update([
            'fullname' => $request->input("fullname") ,
            'email' => $request->input("email") ,
        ]) ;
        return $this->success("اطلاعات کاربر با موفقیت ویرایش گردید.") ;
    }

    public function password(ProfilePassword $request){
        me()->update([
            'password' => bcrypt($request->input("password")) ,
        ]) ;
        return $this->success("پسورد با موفقیت ویرایش گردید.") ;
    }

}
