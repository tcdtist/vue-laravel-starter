<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::all()->pluck('name');
        $role1 = Role::create(['name' => 'Administrador', 'status' => 1]);
        $role1->syncPermissions($permissions);

        $role2 = Role::create(['name' => 'Usuario', 'status' => 1]);
        $role2->syncPermissions(['view payment_methods']);
    }
}
