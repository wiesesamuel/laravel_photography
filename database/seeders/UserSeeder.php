<?php


namespace Database\Seeders;


use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.de',
            'role' => UserRole::Administrator,
        ]);

        $samuel = User::factory()->create([
            'name' => 'Samuel Wiese',
            'email' => 'wiesesamuel@gmail.com',
            'role' => UserRole::Moderator,
        ]);

        $samuel = User::factory()->create([
            'name' => 'Jonas Wiese',
            'email' => 'wiesejonas@gmail.com',
            'role' => UserRole::Moderator,
        ]);

        $asdf = User::factory()->create([
            'name' => 'asdf',
            'email' => 'asdf@asdf.de',
            'role' => UserRole::Unverified,
        ]);


    }


}
