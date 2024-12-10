<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::create([
            'name' => 'Administrator',
            'email' => 'admincrochet@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('Admincrochet')
        ]);

        user::create([
            'name' => 'customer',
            'email' => 'custcrochet@gmail.com',
            'role' => 'customer',
            'password' => Hash::make('Custcrochet')
        ]);
    }
}
