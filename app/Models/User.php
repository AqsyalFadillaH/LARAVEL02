<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', // Default field in users table
        'email', // Default field in users table
        'password', // Default field in users table
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}