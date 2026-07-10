<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Santri Super',
            'username' => 'santri123',
            'email' => 'santri@dh.com',
            'password' => bcrypt('password'),
            'title' => 'Santri',
            'current_streak' => 15,
            'total_attendance' => 45,
        ]);

        // Default Admin User
        User::factory()->create([
            'name' => 'Administrator Utama',
            'username' => 'admin',
            'email' => 'admin@kajian.com',
            'password' => bcrypt('password'),
            'title' => 'Admin',
            'status_aktif' => 'Aktif',
            'current_streak' => 0,
            'total_attendance' => 0,
        ]);
    }
}
