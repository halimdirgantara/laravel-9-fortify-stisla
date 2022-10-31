<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeCollection = Route::getRoutes()->get();
        foreach ($routeCollection as $item) {
            $name = $item->action;
            if(!empty($name['as'])) {
                $permission = $name['as'];
                $permission = trim(strtolower($permission));
                $permission = preg_replace('/[\s.,-]+/', ' ', $permission);
                Permission::create([
                    'name' => $permission
                ]);
            }
        }
        // //user permisson View | Create | Edit | Delete => USER
        // Permission::create(['name' => 'view user']);
        // Permission::create(['name' => 'create user']);
        // Permission::create(['name' => 'edit user']);
        // Permission::create(['name' => 'update user']);
        // Permission::create(['name' => 'delete user']);
        // //user permisson View | Create | Edit | Delete => ROLE
        // Permission::create(['name' => 'view role']);
        // Permission::create(['name' => 'create role']);
        // Permission::create(['name' => 'edit role']);
        // Permission::create(['name' => 'update role']);
        // Permission::create(['name' => 'delete role']);
        // //user permisson View | Create | Edit | Delete => PERMISSION
        // Permission::create(['name' => 'view permission']);
        // Permission::create(['name' => 'create permission']);
        // Permission::create(['name' => 'edit permission']);
        // Permission::create(['name' => 'update permission']);
        // Permission::create(['name' => 'delete permission']);
    }
}
