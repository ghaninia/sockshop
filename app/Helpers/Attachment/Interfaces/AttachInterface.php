<?php
namespace App\Helpers\Attachment\Interfaces ;

interface AttachInterface
{
    public static function disk($name) ;
    public function set($name);
    public function put($name , $usage ) ;
    public static function remove($file) ;
    public function show($items) ;

}
