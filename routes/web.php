<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    $bookCount = \App\Models\Book::count();
    $userCount = \App\Models\User::where('role', 'user')->count();
    return view('welcome', compact('bookCount', 'userCount'));
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // ADMIN ROUTES
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::resource('books', BookController::class);
        Route::resource('users', UserController::class)->except(['edit', 'update', 'show']);
        
        Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
        Route::post('/transactions/{transaction}/return', [TransactionController::class, 'returnBook'])->name('admin.transactions.return');
    });

    // USER ROUTES
    Route::middleware(['role:user'])->prefix('user')->group(function () {
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('user.dashboard');

        Route::get('/catalog', [TransactionController::class, 'userCatalog'])->name('user.catalog');
        Route::post('/borrow/{book}', [TransactionController::class, 'borrow'])->name('user.borrow');
        Route::get('/history', [TransactionController::class, 'userHistory'])->name('user.transactions.history');
    });
});