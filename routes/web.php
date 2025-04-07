<?php
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ThreadController;
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
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// AUTH ROUTES
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/{word?}', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // THREAD ROUTES
    Route::get('/thread/{id}', [ThreadController::class, 'show'])->name('thread.show');
    Route::get('/thread/{id}/edit', [ThreadController::class, 'edit'])->name('thread.edit');
    Route::post('/thread', [ThreadController::class, 'store'])->name('thread.store');
    Route::post('/thread/{id}', [ThreadController::class, 'update'])->name('thread.update');
    Route::get('/thread/delete/{id}', [ThreadController::class, 'destroy'])->name('thread.destroy');

    // COMMENT ROUTES
    Route::get('comment/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

});
