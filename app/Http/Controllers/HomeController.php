<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $routeName = request()->route()->getName();
        $routeName = trim(strtolower($routeName));
        $routeName = preg_replace('/[\s.,-]+/', ' ', $routeName);

        if (!Gate::allows($routeName)) {
            return redirect()->route('profile.edit')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        return view('admin.dashboard.index');
    }
}
