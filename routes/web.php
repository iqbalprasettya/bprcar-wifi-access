<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotspotAdminController;
use App\Http\Controllers\PortalController;

Route::get('/', function () {
    return view('welcome');
});


Route::get ('/portal', [PortalController::class,'show'])->name('portal.show');
Route::post('/portal/login', [PortalController::class,'submit'])->name('portal.submit');

Route::get ('/admin/hotspot/users', [HotspotAdminController::class,'index']);
Route::post('/admin/hotspot/users', [HotspotAdminController::class,'store']);
Route::patch('/admin/hotspot/users/{name}', [HotspotAdminController::class,'update']);
Route::delete('/admin/hotspot/users/{name}', [HotspotAdminController::class,'destroy']);
Route::get ('/admin/hotspot/active', [HotspotAdminController::class,'active']);
Route::post('/admin/hotspot/kick/{user}', [HotspotAdminController::class,'kick']);
