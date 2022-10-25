<?php

namespace App\Http\Services;

use App\DataTable\RoleDataTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleService {
    private $RoleDataTable;

    public function __construct(RoleDataTable $RoleDataTable) {
        $this->RoleDataTable = $RoleDataTable;
    }

    public function getAllRole() {
        $getAllRole = Role::get();
        return $getAllRole;
    }

    public function storeRole($request) {
        try {
            DB::beginTransaction();
            $createRole = Role::create([
                'name' => $request->name,
            ]);
            DB::commit();
            return $createRole;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updateRole($request, $role) {
        try {
            DB::beginTransaction();
            $updateRole = $role->update([
                'name' => $request->name,
            ]);
            DB::commit();
            return $updateRole;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function checkRoleDelete($role) {
        $checkRoleUser = Role::find($role->id)->permission;
        if(is_null($checkRoleUser)) {
            return true;
        }
        return false;
    }
}
