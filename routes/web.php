<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest routes
Route::middleware(['guest'])->group(function () {

    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
    Route::get('/login', function () {
        return view('auth.login');
    })->name('auth.login');

    // POST ROUTES
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// AUTH ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});
