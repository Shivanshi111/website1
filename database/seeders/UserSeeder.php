<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this line for the DB facade
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Insert Admin User
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'), // Admin password
                'role' => 1, // Assuming role 1 is admin
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Insert Regular User
            DB::table('users')->insert([
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'), // Regular user password
                'role' => 0, // Assuming role 0 is a regular user
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
