<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (!$user->profile) {
                Profile::create([
                    'user_id' => $user->id,
                    'username' => $user->name ?? 'User' . $user->id,
                    'NIM' => 'NIM' . $user->id,
                    'email' => $user->email,
                    'password' => $user->password ?? Hash::make('password'),
                ]);
            }
        }
    }
}