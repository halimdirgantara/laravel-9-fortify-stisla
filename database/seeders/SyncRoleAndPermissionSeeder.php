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
        $author = Role::find(4); //Author role
        $user = Role::find(5); //Author role

        $superadmin->syncPermissions([
            'role assign permission',
            'update role permission',
            'user assign permission',
            'update user permission',
            'user assign role',
            'update user role',
            'user index',
            'user show',
            'user store',
            'user edit',
            'user update',
            'user destroy',
            'role index',
            'role show',
            'role store',
            'role edit',
            'role update',
            'role destroy',
            'permission index',
            'permission show',
            'permission store',
            'permission edit',
            'permission update',
            'permission destroy',
            'category index',
            'category show',
            'category store',
            'category edit',
            'category update',
            'category destroy',
            'post index',
            'post show',
            'post create',
            'post store',
            'post edit',
            'post update',
            'post destroy',

        ]);

        $admin->syncPermissions([
        ]);

        $editor->syncPermissions([
        ]);

        $author->syncPermissions([
        ]);

        $user->syncPermissions([
        ]);
    }
}
