<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::middleware(['auth:sanctum', 'verified', 'permissions'])->prefix('admin')->group(function () {

	/*Route for users*/
	Route::get('/', [DashboardController::class, 'dashboard']);
	Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
	Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
	Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
	Route::post('/users/store', [UsersController::class, 'store'])->name('admin.users.store');
	Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
	Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
	Route::get('/users/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.delete');
	Route::post('/users/update-password/{id}', [UsersController::class, 'update_password'])->name('admin.users.update-password');
	Route::post('/users/update-roles/{id}', [UsersController::class, 'update_user_roles'])->name('admin.users.update_user_roles');
	Route::match(['get', 'post'], '/profile', [UsersController::class, 'profile'])->name('admin.users.profile');
	Route::get('user/remove_image/{id}', [UsersController::class, 'remove_user_image'])->name('admin.user.remove_user_image');

	/*Route for Roles*/
	Route::get('/roles', [RolesController::class, 'index'])->name('admin.roles.index');
	Route::get('/roles/create', [RolesController::class, 'create'])->name('admin.roles.create');
	Route::post('/roles/store', [RolesController::class, 'store'])->name('admin.roles.store');
	Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])->name('admin.roles.edit');
	Route::post('/roles/update/{id}', [RolesController::class, 'update'])->name('admin.roles.update');
	Route::get('/roles/delete/{id}', [RolesController::class, 'destroy'])->name('admin.roles.delete');


});