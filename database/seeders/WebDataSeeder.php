<?php


namespace Database\Seeders;


use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;

class AlbumSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // faker
        $path_faker = config('files.fakedata.source_absolute_path');
        $album_faker_dirs = File::directories($path_faker);

        foreach ($album_faker_dirs as $dir) {
            File::copyDirectory($dir)

        }
        // destination
        $path_production = config('files.gallery.source_absolute_path');
        $album_prod_dirs = File::directories();

        foreach ()
        File::exists()
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.de',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => UserRole::Administrator,
        ]);
    }


}
