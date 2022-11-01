<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
