<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'gender',
        'mobile',
        'password',
        'role',
    ];

    protected $hidden = [
        'mobile',
        'role',
        'password',
        'remember_token',
    ];

    public const GENDER_TYPE = [
        "male",
        "female"
    ];

    private const ROLE_TYPE_ADMIN = "admin";
    private const ROLE_TYPE_USER  = "user";
    public const  ROLE_TYPE = [
        SELF::ROLE_TYPE_ADMIN,
        SELF::ROLE_TYPE_USER
    ];

    public function isAdmin()
    {
        return $this->role === SELF::ROLE_TYPE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === SELF::ROLE_TYPE_USER;
    }

}
