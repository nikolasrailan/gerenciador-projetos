<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionSeeder::class,
            UserSeeder::class
        ]);


        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                $user->assignRole('admin');
            });

        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                $user->assignRole('cliente');
            });

        
    }
}
