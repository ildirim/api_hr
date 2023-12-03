<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\Admin::create([
             'first_name' => 'Test User',
             'last_name' => 'Test User',
             'email' => 'admin@admin.com',
             'password' => bcrypt('admin'),
             'phone' => 'Test User',
             'profile_image' => 'Test User',
         ]);
    }
}
