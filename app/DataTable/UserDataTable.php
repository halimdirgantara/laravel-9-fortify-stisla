<?php

namespace App\DataTable;
use Yajra\DataTables\Facades\DataTables;

class UserDataTable {

    public function userTable ($data) {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function($row){
                $role =  $row->roles->pluck('name')->first();
                if(!empty($role)) {
                    return $role;
                }
                return 'No Role';
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action','role'])
            ->make(true);
    }

}
