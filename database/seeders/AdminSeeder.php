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

        User::factory()
            ->count(10)
            ->create();
        // User::create([
        //     'name' => "Admin",
        //     'email' => "admin@email.com",
        //     'password' => Hash::make('password'),
        // ]);

    }
}
