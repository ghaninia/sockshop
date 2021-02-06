<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUS_PENDING  = 0;
    public const STATUS_ACCEPTED = 1;
    public const STATUS_REJECTED = 2;
    public const STATUS_TYPES = [
        SELF::STATUS_PENDING,
        SELF::STATUS_ACCEPTED,
        SELF::STATUS_REJECTED
    ];
}
