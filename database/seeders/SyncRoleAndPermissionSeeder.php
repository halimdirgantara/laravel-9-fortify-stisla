<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SyncRoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::find(1); //Super admin role
        $admin = Role::find(2); //Admin role
        $editor = Role::find(3); //Editor role
        // $author = Role::find(4); //Author role
        // $user = Role::find(5); //Author role

        $superadmin->syncPermissions([
            'view user',
            'create user',
            'edit user',
            'update user',
            'delete user',
            'view role',
            'create role',
            'update role',
            'edit role',
            'delete role',
            'view permission',
            'create permission',
            'edit permission',
            'delete permission'
        ]);

        $admin->syncPermissions([
            'view user',
            'create user',
            'update user',
            'view role',
            'view permission',
        ]);

        $editor->syncPermissions([
            'view user',
        ]);
    }
}
