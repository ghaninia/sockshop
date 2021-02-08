<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "address_id" ,
        "product_id" ,
        "variance_id" ,
        "fullname" ,
        "mobile" ,
        "price" ,

        "transaction_id" ,
        "tracking_code" ,

        "post_tracking_code" ,
        "post_trackinged_at"
    ] ;

    public $dates = [
        "post_trackinged_at"
    ] ;


    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variance()
    {
        return $this->belongsTo(Variance::class);
    }
}
