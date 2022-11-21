<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguangeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomepageController;

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


Route::get('/', [HomepageController::Class, 'index'])->name('homepage');
Route::get('blog', [BlogController::Class, 'index'])->name('blog');
Route::get('blog/{slug}', [BlogController::Class, 'show'])->name('blog.show');
Route::get('category', [BlogController::Class, 'allCategory'])->name('blog.category.index');
Route::get('category/{slug}', [BlogController::Class, 'getCategory'])->name('blog.category.show');

Route::get('/register/lang', [LanguangeController::class, 'change'])->name('changeLang');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::Class, 'index'])->name('dashboard');
    //Change User Password
    Route::put('user/change-password', [UserController::Class, 'changePassword'])->name('user.change_password');

    //Role and Permission Changes
    Route::get('role/{id}/assign-permission',[RoleController::class,'assignPermission'])->name('role.assign.permission');
    Route::put('role/{id}/permission',[RoleController::class,'updatePermission'])->name('update.role.permission');
    Route::get('user/{id}/assign-permission',[UserController::class,'assignPermission'])->name('user.assign.permission');
    Route::put('user/{id}/permission',[UserController::class,'updatePermission'])->name('update.user.permission');
    Route::get('user/{id}/assign-role',[UserController::class,'assignRole'])->name('user.assign.role');
    Route::put('user/{id}/role',[UserController::class,'updateRole'])->name('update.user.role');

    //User Route Resources
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    //Blog Resources
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);

    //User Profile
    Route::get('profile/edit', [ProfileController::Class, 'index'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::Class, 'update'])->name('profile.update');
});
});
