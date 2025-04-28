<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'birthdate',
        'gender',
        'faculty',
        'major',
    ];

    protected $casts = [
        'birthdate' => 'date:Y-m-d',
        'gender' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}