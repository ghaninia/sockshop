<?php

namespace App\Helpers\Traits;

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
}
