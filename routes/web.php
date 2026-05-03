<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [BorrowController::class, 'index'])->name('home');
    Route::get('/borrow/{book_id}', [BorrowController::class, 'create'])->name('borrow.create');
    Route::post('/borrow', [BorrowController::class, 'store'])->name('borrow.store');
    Route::get('/my-borrowings', [BorrowController::class, 'myBorrowings'])->name('borrow.my');
    Route::post('/borrowings/{id}/request-return', [BorrowController::class, 'requestReturn'])->name('borrow.requestReturn');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::post('/borrowings/{id}/approve', [BorrowingController::class, 'approve'])->name('borrowings.approve');
    Route::post('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    Route::post('/borrowings/{id}/reject-return', [BorrowingController::class, 'rejectReturn'])->name('borrowings.rejectReturn');
    Route::post('/borrowings/{id}/reject', [BorrowingController::class, 'reject'])->name('borrowings.reject');
    Route::resource('borrowings', BorrowingController::class);
});
