<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'NIM',
        'email',
        'password',
        'terms_agreed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profiles()
    {
        return $this->hasOne(Profiles::class, 'user_id');
    }
}