<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApexAuthController;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [ApexAuthController::class, 'login']);
    Route::post('/refresh', [ApexAuthController::class, 'refresh']);
    Route::post('/logout', [ApexAuthController::class, 'logout']);
});

// Example protected route
Route::middleware(['apex.auth'])->group(function () {
    Route::get('/user', function () {
        return response()->json(auth()->user());
    });
});