<?php

use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GaleriCategoriesController;
use App\Http\Controllers\Admin\GaleriTagsController;

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

Route::middleware(['auth:sanctum', 'verified', 'permissions'])->prefix('admin/galeri')->group(function () {

    Route::get('/', [GaleriController::class, 'admin_index'])->name('galeri.admin.index');
    Route::get('/create', [GaleriController::class, 'admin_create'])->name('galeri.admin.create');
    Route::post('/store', [GaleriController::class, 'admin_store'])->name('galeri.admin.store');
    Route::get('/edit/{id}', [GaleriController::class, 'admin_edit'])->name('galeri.admin.edit');
    Route::post('/update/{id}', [GaleriController::class, 'admin_update'])->name('galeri.admin.update');
    Route::get('/delete/{id}', [GaleriController::class, 'destroy'])->name('galeri.admin.delete');
    // Route::get('/trash-status/{id}', [BlogsController::class, 'admin_trash_status'])->name('blog.admin.admin_trash_status');
    // Route::get('/restore-blog/{id}', [BlogsController::class, 'restore_blog'])->name('blog.admin.restore_blog');
    // Route::get('/trashed-blogs', [BlogsController::class, 'trash_list'])->name('blog.admin.trash_list');
    // Route::get('/remove_feature_image/{id}', [BlogsController::class, 'remove_feature_image'])->name('blog.admin.remove_feature_image');


});
