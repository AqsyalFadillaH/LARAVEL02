<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'NIM',
        'email',
        'password',
        'terms_agreed',
        'is_verified',
        'role_id', // Added
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'terms_agreed' => 'boolean',
        'is_verified' => 'boolean', // Added
    ];

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }

    public function role()
    {
        return $this->belongsTo(Roleuser::class, 'role_id', 'id');
    }
}