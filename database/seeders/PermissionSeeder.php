<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name' => 'Show Admin', 'guard_name' => 'admin'],
            ['name' => 'Store Admin', 'guard_name' => 'admin'],
            ['name' => 'Update Admin', 'guard_name' => 'admin'],
            ['name' => 'Delete Admin', 'guard_name' => 'admin'],
        ]);
    }
}
