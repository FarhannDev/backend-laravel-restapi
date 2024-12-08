<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/register', App\Http\Controllers\Api\Auth\RegisterController::class);
Route::post('/auth/login', App\Http\Controllers\Api\Auth\LoginController::class);
Route::post('/auth/logout', App\Http\Controllers\Api\Auth\LogoutController::class);

Route::prefix('users')->middleware('auth.middlewate')->group(function () {
    Route::get('/current', function () {
        return Auth::user()->name;
    });
});
