<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotspotAdminController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Route utama langsung ke portal login
Route::get('/', [PortalController::class, 'show'])->name('portal.show');
Route::post('/login', [PortalController::class, 'submit'])->name('portal.submit');

// Route dashboard user
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

// Route admin login
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route admin logs & monitoring (protected)
Route::get('/admin/logs', [AdminController::class, 'logs'])->name('admin.logs')->middleware('admin.auth');
Route::get('/admin/active-users', [AdminController::class, 'activeUsers'])->name('admin.active-users')->middleware('admin.auth');
Route::post('/admin/kick-user/{username}', [AdminController::class, 'kickUser'])->name('admin.kick-user')->middleware('admin.auth');

// Route admin user management
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users')->middleware('admin.auth');
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create')->middleware('admin.auth');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store')->middleware('admin.auth');
Route::get('/admin/users/{username}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit')->middleware('admin.auth');
Route::put('/admin/users/{username}', [AdminController::class, 'updateUser'])->name('admin.users.update')->middleware('admin.auth');
Route::delete('/admin/users/{username}', [AdminController::class, 'deleteUser'])->name('admin.users.delete')->middleware('admin.auth');

// Route admin hotspot management
Route::get('/admin/hotspot/users', [HotspotAdminController::class, 'index']);
Route::post('/admin/hotspot/users', [HotspotAdminController::class, 'store']);
Route::patch('/admin/hotspot/users/{name}', [HotspotAdminController::class, 'update']);
Route::delete('/admin/hotspot/users/{name}', [HotspotAdminController::class, 'destroy']);
Route::get('/admin/hotspot/active', [HotspotAdminController::class, 'active']);
Route::post('/admin/hotspot/kick/{user}', [HotspotAdminController::class, 'kick']);
