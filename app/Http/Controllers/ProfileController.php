<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        $title = 'Edit Profile';
        return view('admin.profile.index',[
            'user' => $user,
            'title' => $title,
        ]);
    }
    public function update(UpdateProfileRequest $request) {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect()->back()->with([
            'alert-icon' => 'success',
            'alert-type' => 'success',
            'alert-message' => 'Update Profile Success',
        ]);;
    }
}
