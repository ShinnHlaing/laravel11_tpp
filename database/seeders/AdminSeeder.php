<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // User::factory()
        //     ->count(10)
        //     ->create();
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            // 'phone' => "09777777777",
            // 'address' => "Yangon, Myanmar",
            'password' => Hash::make('password'),
        ]);
        $user = User::create([
            'name' => "User",
            'email' => "user@mail.com",
            // 'phone' => "09888888888",
            // 'address' => "Mandalay, Myanmar",
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
