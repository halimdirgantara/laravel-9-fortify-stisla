<?php

namespace App\DataTable;
use App\Http\Services\permissionService;
use Yajra\DataTables\Facades\DataTables;

class RoleDataTable {
    private $permissionService;

    public function __construct(
        permissionService $permissionService,
        ) {
        $this->permissionService = $permissionService;
    }

    public function roleTable ($data) {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('permission', function($row){
                $permissionList = $this->permissionService->getPermissionByRole($row->id);
                if(empty($permissionList)) {
                    $permission = '<a href="javascript:void(0)" class="permission btn btn-info btn-sm">No Permission Available</a>';
                } else {
                    $permission = '';
                    foreach ($permissionList as $item) {
                        $permission = $permission.'<a href="javascript:void(0)" class="permission btn btn-info btn-sm m-1">'.$item->name.'</a>';
                    }
                }
                return $permission;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="assign btn btn-info btn-sm m-1">Assign Permission</a>
                                <a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm m-1">Edit</a>
                                <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm m-1">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['permission','action'])
            ->make(true);
    }

}
