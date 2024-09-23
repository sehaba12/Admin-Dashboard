<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/check-admin', [PermissionController::class, 'checkAdmin']);
    Route::get('/user/permissions', [PermissionController::class, 'getUserPermissions']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'check']);


Route::get('stat', [App\Http\Controllers\statisticLogs::class, 'stat']);
Route::get('index', [App\Http\Controllers\LogController::class, 'index']);
Route::get('userstable', [App\Http\Controllers\NewUser::class, 'userstable']);
Route::post('store', [App\Http\Controllers\NewUser::class, 'store']);
// Route::middleware('auth:api')->get('/permissions', [PermissionController::class, 'getPermissions']);

