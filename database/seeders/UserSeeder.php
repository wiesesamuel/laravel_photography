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
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => UserRole::Administrator,
        ]);

        $samuel = User::factory()->create([
            'name' => 'Samuel Wiese',
            'email' => 'wiesesamuel@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => UserRole::Moderator,
        ]);


        $asdf = User::factory()->create([
            'name' => 'asdf',
            'email' => 'asdf@asdf.de',
            'role' => UserRole::Unverified,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        /*
                App\Models\User::create([
                    'name' => 'Admin',
                    'email' => 'admin@admin.de',
                    'role' => 5,
                                'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]);*/

    }


}
