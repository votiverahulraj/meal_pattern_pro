<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/custom-register', [AuthController::class,'customregister'])->name('custom.register');
Route::post('/custom-register-process', [AuthController::class,'registerProcess'])->name('custom.register.process');
Route::post('/login-process', [AuthController::class,'Authenticated'])->name('login.process');
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function(){
    Route::get('/district/dashboard', [AuthController::class,'districtDashboard'])->name('district.dashboard');
});


Route::get('/table', function () {
    return view('pages.table');
});

Route::get('/form', function () {
    return view('pages.form');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/list', [UserController::class,'userList'])->name('user.list');
    Route::get('/user/add', [UserController::class,'userAdd'])->name('user.add');
    Route::get('/user/details/{id}', [UserController::class,'userDetails'])->name('user.details');
    Route::post('/user-process', [UserController::class,'userProcess'])->name('user.process');
    Route::post('/user-update/{id}', [UserController::class,'userUpdate'])->name('user.update');
    Route::get('/user/edit/{id}', [UserController::class,'userEdit'])->name('user.edit');
    Route::get('/user/delete/{id}', [UserController::class,'userDelete'])->name('user.delete');
    //  Route::resource('products', ProductController::class);

});
Route::get('/home', [HomeController::class,'index'])->name('home');
require __DIR__.'/auth.php';
