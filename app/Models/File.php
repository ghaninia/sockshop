<?php

namespace App\Models;

use App\Helpers\Attachment\Attach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'size' ,
        'usage' ,
        'format' ,
        'disk' ,
        'url' ,
        'fileable_id' ,
        'fileable_type' ,
    ];

    protected $guarded = [
        'fileable_id' ,
        'fileable_type' ,
    ];

    public $timestamps = false ;

    protected $dates = [
        'created_at'
    ];

    public function fileables(){
        return $this->morphTo() ;
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($file){
            Attach::remove($file) ;
        });
    }

    public static function pull( $item , $filename , $usage )
    {
        if( request()->has($filename) )
            $item->files()->where(['usage'=>$usage,'disk'=>config('site.disk')])->each(function ($query){
                $query->delete() ;
            });
        else
            return false ;
        return self::put($item , $filename , $usage) ;
    }

    public static function put( $item , $filename , $usage )
    {
        $uploads = Attach::disk()->put($filename , $usage) ;
        if (is_array($uploads) && !empty($uploads))
        {
            $item->files()->createMany($uploads) ;
            return true ;
        }
        return false ;
    }

    public static function show( $item , $usage = null , $size = "full" )
    {
        $where = [
            'disk'   => config('site.disk') ,
            'usage'  => $usage ,
            'size'   => $size
        ];
        $items = $item->files()->where($where) ;
        $items = $items->pluck('url') ;
        return Attach::disk( config('site.disk') )->show($items) ;
    }
}
