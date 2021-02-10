<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "summary",
        "description",
        "keywords" ,
        "slug"
    ];

    protected $casts = [
        "keywords" => "array"
    ];

    public function files()
    {
        return $this->morphMany(File::class, "fileable");
    }

    public function variances()
    {
        return $this->hasMany(Variance::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
