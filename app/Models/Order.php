<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "address_id",
        "product_id",
        "variance_id",
        "fullname",
        "mobile",
        "price",
        "status",
        "reference_id" ,
        "transaction_id",
        "tracking_code",
        "post_tracking_code",
        "post_trackinged_at"
    ];

    public $dates = [
        "post_trackinged_at"
    ];

    const STATUS_SUCCEED = "STATUS_SUCCEED";
    const STATUS_FAILED = "STATUS_FAILED";
    const STATUS_INIT = "STATUS_INIT";

    const STATUES = [
        SELF::STATUS_SUCCEED,
        SELF::STATUS_FAILED,
        SELF::STATUS_INIT,
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
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
