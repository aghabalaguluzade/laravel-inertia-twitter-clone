<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $aghabala = User::create([
            'name' => 'Aghabala Guluzade',
            'username' => 'aghabalaguluzade',
            'email' => 'aghabalaguluzade@gmail.com',
            'password' => bcrypt('aghabala2313'),
            'profile_photo_path' => 'https://laravel.gen.tr/assets/avatars/PVMs9tAS31YX9uaD.png',
            'created_at' => now(),
            'updated_at' => null,
        ]);

        $aghabala->followers()->attach(User::factory(100)->create()->pluck('id'));
        $aghabala->followings()->attach(User::factory(100)->create()->pluck('id'));

        User::factory(1000)->create();
        Tweet::factory(100000)->create();
    }
}
