<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
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
    Route::post(
        '/borrowings/{id}/request-extend',
        [BorrowController::class, 'requestExtend']
    )
        ->name('borrow.requestExtend');

    Route::post(
        '/borrowings/{id}/approve-extend',
        [BorrowingController::class, 'approveExtend']
    )
        ->name('borrowings.approveExtend');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/books/export/pdf', [BookController::class, 'exportPdf'])
        ->name('books.export.pdf');
    Route::get('/books/export/excel', [BookController::class, 'exportExcel'])
        ->name('books.export.excel');
    Route::resource('books', BookController::class);
    Route::get('/members/export/pdf', [MemberController::class, 'exportPdf'])
        ->name('members.export.pdf');
    Route::get('/members/export/excel', [MemberController::class, 'exportExcel'])
        ->name('members.export.excel');
    Route::resource('members', MemberController::class);
    Route::resource('admins', AdminController::class);
    Route::post('/borrowings/{id}/approve', [BorrowingController::class, 'approve'])->name('borrowings.approve');
    Route::post('/borrowings/{id}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    Route::post('/borrowings/{id}/reject-return', [BorrowingController::class, 'rejectReturn'])->name('borrowings.rejectReturn');
    Route::post('/borrowings/{id}/reject', [BorrowingController::class, 'reject'])->name('borrowings.reject');
    Route::post('/borrowings/{id}/reject-extend', [BorrowingController::class, 'rejectExtend'])->name('borrowings.rejectExtend');
    Route::get('/borrowings/export/pdf', [BorrowingController::class, 'exportPdf'])
        ->name('borrowings.export.pdf');
    Route::get('/borrowings/export/excel', [BorrowingController::class, 'exportExcel'])
        ->name('borrowings.export.excel');
    Route::resource('borrowings', BorrowingController::class);
});
