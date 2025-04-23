<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'username',
        'NIM',
        'email',
        'password',
        'birthdate',
        'gender',
        'faculty',
        'major',
        'user_id',
    ];

    protected $casts = [
        'birthdate' => 'date:Y-m-d', // Format date as YYYY-MM-DD
        'gender' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}