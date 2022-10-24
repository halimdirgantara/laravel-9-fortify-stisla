<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\userService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\changePasswordRequest;

class UserController extends Controller
{
    private $UserService;

    public function __construct(userService $userService) {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $title = "Users List";
        // $getUser = $this->userService->getUsers();
        if($request->ajax()){
            return $this->userService->getUsers();
        }
        return view('admin.users.index',[
            'title' => 'User List',
        ]);
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
