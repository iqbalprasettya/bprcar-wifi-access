<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotspotAdminController;
use App\Http\Controllers\PortalController;

// Route utama langsung ke portal login
Route::get('/', [PortalController::class, 'show'])->name('portal.show');
Route::post('/login', [PortalController::class, 'submit'])->name('portal.submit');

Route::get('/admin/hotspot/users', [HotspotAdminController::class, 'index']);
Route::post('/admin/hotspot/users', [HotspotAdminController::class, 'store']);
Route::patch('/admin/hotspot/users/{name}', [HotspotAdminController::class, 'update']);
Route::delete('/admin/hotspot/users/{name}', [HotspotAdminController::class, 'destroy']);
Route::get('/admin/hotspot/active', [HotspotAdminController::class, 'active']);
Route::post('/admin/hotspot/kick/{user}', [HotspotAdminController::class, 'kick']);
