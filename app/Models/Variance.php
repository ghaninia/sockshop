<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variance extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "title",
        "tooltip",
        "price", // دریافتی ها بر حسب ریال است
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPrice()
    {
        return number_format( $this->price / 10 ) ;
    }

    public function getPriceUnit()
    {
        return "تومـان" ;
    }

}
