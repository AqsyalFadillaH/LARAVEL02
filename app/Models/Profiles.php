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
        'hobby',
    ];

    protected $casts = [
       'birthdate' => 'date',
        'gender' => 'string', // Treat enum as string
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
