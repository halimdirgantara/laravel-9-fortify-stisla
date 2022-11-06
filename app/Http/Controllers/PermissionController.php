<?php

namespace App\Http\Controllers;

use App\Helper\RouteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTable\PermissionDataTable;
use App\Http\Services\permissionService;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;

class PermissionController extends Controller
{
    private $permissionService;
    private $PermissionDataTable;

    public function __construct(PermissionDataTable $PermissionDataTable, permissionService $permissionService) {
        $this->permissionService = $permissionService;
        $this->PermissionDataTable = $PermissionDataTable;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        $title = 'Permission List';
        $newButton = 'Create New Permission';
        $getAllPermission = $this->permissionService->getAllPermission();
        if($request->ajax()) {
            return $this->PermissionDataTable->permissionTable($getAllPermission);
        }
        return view('admin.permissions.index',[
            'title' => $title,
            'newButton' => $newButton,
            'permission' => new Permission(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request) {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        // Save permission to database
        $createPermission = $this->permissionService->storePermission($request);
        if ($createPermission) {
            return redirect()->back()->with([
                'alert-icon' => 'success',
                'alert-type' => 'Created!',
                'alert-message' => 'Success Create New Permission',
            ]);
        }
        return redirect()->back()->with([
            'alert-icon' => 'error',
            'alert-type' => 'Failed!',
            'alert-message' => 'Create Permission Failed:',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission) {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        return view('admin.permissions.edit', [
            'title' => 'Edit Permission',
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission) {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }
        // update user to database
        $updatePermission = $this->permissionService->updatePermission($request, $permission);
        if ($updatePermission) {
            return redirect()->back()->with([
                'alert-icon' => 'success',
                'alert-type' => 'Updated!',
                'alert-message' => 'Success Update '.$permission->name,
            ]);
        }
        return redirect()->back()->with([
            'alert-icon' => 'error',
            'alert-type' => 'Error',
            'alert-message' => 'Update Permission Failed:',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission) {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }
        // Check user before deleting user
        $check = $this->permissionService->checkPermissionDelete($permission);
        if($check) {
            $permission->delete();
            return response()->json([
                'icon'=>'success',
                'title' => 'Success!',
                'message' => 'Success Delete Permission']
            ,200);
        }
        return response()->json([
            'icon'=>'error',
            'title' => 'Error!',
            'message' => 'Failed to delete permission!']
        ,403);
    }
}
