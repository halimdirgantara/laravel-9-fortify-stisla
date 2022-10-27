<?php

namespace App\DataTable;
use App\Http\Services\roleService;
use Yajra\DataTables\Facades\DataTables;

class UserDataTable {
    private $roleService;

    public function __construct(
        roleService $roleService,
        ) {
        $this->roleService = $roleService;
    }

    public function userTable ($data) {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function($row){
                $role = $this->roleService->getRoleByUser($row->id);
                $button = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="assignRole btn btn-warning btn-sm m-1">Assign Role</a>';
                if(!empty($role[0]->name)) {
                    $button = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="assignRole btn btn-info btn-sm m-1">'.$role[0]->name.'</a>';
                }
                return $button;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm m-1">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm m-1">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action','role'])
            ->make(true);
    }

}
