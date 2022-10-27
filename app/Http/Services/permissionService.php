<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use App\DataTable\PermissionDataTable;
use Spatie\Permission\Models\Permission;


class permissionService {
    private $PermissionDatatable;

    public function __construct(PermissionDataTable $PermissionDatatable) {
        $this->PermissionDatatable = $PermissionDatatable;
    }

    public function getAllPermission() {
        $getAllPermission = Permission::get();
        return $getAllPermission;
    }

    public function getPermissionByRole($id) {
        $permission = Permission::whereRelation('roles', 'id', '=', $id)
                        ->get('name');
        return $permission;
    }

    public function getPermissionByUser($id) {
        $permission = Permission::whereRelation('users', 'id', '=', $id)
                        ->get('name');
        return $permission;
    }

    public function storePermission($request) {
        try {
            DB::beginTransaction();
            $createPermission = Permission::create([
                'name' => $request->name,
            ]);
            DB::commit();
            return $createPermission;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updatePermission($request, $permission) {
        try {
            DB::beginTransaction();
            $updatePermission = $permission->update([
                'name' => $request->name,
            ]);
            DB::commit();
            return $updatePermission;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function checkPermissionDelete($permission) {
        $checkPermissionRoles = Permission::find($permission->id)->roles;
        if($checkPermissionRoles->isEmpty()) {
            return true;
        }
        return false;
    }

    public function syncPermisionToRole($role, $request) {
        try {
            $role->syncPermissions($request->permissions);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function syncPermisionToUser($user, $request) {
        try {
            $user->syncPermissions($request->permissions);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
