<?php

namespace Database\Seeders;

use App\Http\Enums\ActivationStatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::insert([
            ['group_name' => 'admin', 'name' => 'Show Admin', 'method_name' => 'App\Http\Controllers\AdminController@admins', 'guard_name' => 'admin'],
            ['group_name' => 'admin', 'name' => 'Store Admin', 'method_name' => 'App\Http\Controllers\AdminController@admins', 'guard_name' => 'admin'],
            ['group_name' => 'admin', 'name' => 'Update Admin', 'method_name' => 'App\Http\Controllers\AdminController@admins', 'guard_name' => 'admin'],
            ['group_name' => 'admin', 'name' => 'Delete Admin', 'method_name' => 'App\Http\Controllers\AdminController@admins', 'guard_name' => 'admin'],
        ]);

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'admin',
            'status' => ActivationStatusEnum::ACTIVE
        ]);
        $role->syncPermissions($permissions);
    }
}
