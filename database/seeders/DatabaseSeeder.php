<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);

        User::create([
            'name' => 'Felix Hernandez',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'remember_token' => Str::random(10),
        ])->assignRole('Admin');
        // User::factory(20)->create();
        // \App\Models\User::factory(10)->create();
    }
}
