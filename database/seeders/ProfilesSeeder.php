<?php

namespace Database\Seeders;

use App\Models\Profiles;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (!$user->profiles) {
                Profiles::create([
                    'user_id' => $user->id,
                    'faculty' => 'Sample Faculty',
                    'major' => 'Sample Major',
                ]);
            }
        }
    }
}