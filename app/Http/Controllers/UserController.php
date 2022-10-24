<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTable\UserDataTable;
use App\Http\Services\userService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    private $UserService;
    private $UserDataTable;

    public function __construct(userService $userService, UserDataTable $userDataTable) {
        $this->userService = $userService;
        $this->userDataTable = $userDataTable;
    }

    public function index(Request $request)
    {
        $title = "Users List";
        // Get all users from the user services
        $AllUser = $this->userService->getUsers();
        // Get datatables from datatables service
        if($request->ajax()){
            return $this->userDataTable->userTable($AllUser);
        }
        //return to user list view
        return view('admin.users.index',[
            'title' => 'User List',
            'user' => new User(),
        ]);
    }

    public function store(UserStoreRequest $request) {
        $createUser = $this->userService->storeUser($request);
        if ($createUser) {
            return redirect()->back()->with([
                'alert-icon' => 'success',
                'alert-type' => 'Created!',
                'alert-message' => 'Success Create New User',
            ]);
        }
        return redirect()->back()->with([
            'alert-icon' => 'error',
            'alert-type' => 'Error',
            'alert-message' => 'Create User Failed:',
        ]);
    }

    public function edit(User $user) {
        return view('admin.users.edit', [
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user) {
        $updateUser = $this->userService->updateUser($request, $user);
        if ($updateUser) {
            return redirect()->back()->with([
                'alert-icon' => 'success',
                'alert-type' => 'Updated!',
                'alert-message' => 'Success Update '.$user->name,
            ]);
        }
        return redirect()->back()->with([
            'alert-icon' => 'error',
            'alert-type' => 'Error',
            'alert-message' => 'Create User Failed:',
        ]);
    }

    public function destroy(User $user) {
        $check = $this->userService->checkUserDelete($user);
        if($check) {
            $user->delete();
            return response()->json([
                'icon'=>'success',
                'title' => 'Success!',
                'message' => 'Success Delete User']
            ,200);
        }
        return response()->json([
            'icon'=>'error',
            'title' => 'Error!',
            'message' => 'Failed to delete user!']
        ,403);
    }

    public function changePassword (changePasswordRequest $request) {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            Auth::user()->fill([
                'password' => Hash::make($request->password),
            ])->save();
            return redirect()->route('profile.edit')->with([
                'alert-icon' => 'success',
                'alert-type' => 'Success',
                'alert-message' => 'Success Change Password',
            ]);
        } else {
            return redirect()->route('profile.edit')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Error',
                'alert-message' => 'Old Password Wrong !',
            ]);
        }
    }
}
