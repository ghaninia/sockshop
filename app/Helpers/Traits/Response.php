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
            return $exec;
        }
    }

    public function fail($info)
    {
        if (is_array($info)) {
            $info["ok"] = true;
            return response()->json($info);
        } else {
            $exec["msg"] = $info;
            $exec["ok"] = true;
            return $exec;
        }
    }
}
