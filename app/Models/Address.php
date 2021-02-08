<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id" ,
        "province_id" ,
        "city_id" ,
        "address" ,
        "postal_code" ,
        "phone" ,
        "national_code" ,
    ] ;
    public function order (){
        return $this->hasOne( Order::class ) ;
    }
}
