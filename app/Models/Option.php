<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        "key",
        "value",
        "default"
    ];
    public $timestamps = false;

    private const CACHE_KEY = "options_cache";

    public static function generate()
    {
        if (Cache::has(Option::CACHE_KEY))
            return Cache::get(Option::CACHE_KEY);

        $options = self::select(["id", "key", "value", "default"])->get();
        Cache::put(Option::CACHE_KEY, $options, 10);
        return $options;
    }

    public static function input($key, $default = null, $SendDefaultIfNotExistsValue = true)
    {
        $hasKey = static::generate()->where("key", $key);
        if ($hasKey->count()) {
            $hasKey = $hasKey->first();
            if (!!$hasKey->value && $SendDefaultIfNotExistsValue) {
                return $hasKey->value;
            } elseif (!$SendDefaultIfNotExistsValue) {
                return $default;
            } elseif (!!$hasKey->default) {
                return !!$default ? $default : $hasKey->default;
            }
        }
        return $default;
    }

    public static function put($key, $value)
    {
        static::where("key", $key)->update([
            "value" => $value
        ]);
        return true;
    }
}
