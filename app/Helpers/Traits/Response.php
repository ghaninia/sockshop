<?php

namespace App\Helpers\Traits;

use Hekmatinasser\Verta\Facades\Verta;

trait Response
{

    public function success($info)
    {
        if (is_array($info)) {
            $info["ok"] = true;
            return response()->json($info);
        } else {
            $exec["msg"] = $info;
            $exec["ok"] = true;
            return response()->json($exec);
        }
    }

    public function fail($info)
    {
        if (is_array($info)) {
            $info["ok"] = false ;
            return response()->json($info , 400 );
        } else {
            $exec["msg"] = $info;
            $exec["ok"] = false;
            return response()->json($exec , 400 );        }
    }

    public function jalaliToDatetime( $date ) {
        return Verta::parseFormat('Y/m/d', $date )->datetime() ;
    }

}
