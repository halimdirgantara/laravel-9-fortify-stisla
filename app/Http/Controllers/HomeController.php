<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($subdomain) {
        dd($subdomain);
        return view('admin.dashboard.index');
    }
}
