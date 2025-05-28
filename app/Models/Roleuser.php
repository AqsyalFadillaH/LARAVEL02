<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
    protected $table = 'roleuser';
    protected $fillable = ['role'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}