<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguangeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register/lang', [LanguangeController::class, 'change'])->name('changeLang');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [HomeController::Class, 'index'])->name('dashboard');
    //Change User Password
    Route::put('user/change-password', [UserController::Class, 'changePassword'])->name('user.change_password');

    //User Route Resources
    Route::resource('user', UserController::class);

    //User Profile
    Route::get('profile/edit', [ProfileController::Class, 'index'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::Class, 'update'])->name('profile.update');
});
