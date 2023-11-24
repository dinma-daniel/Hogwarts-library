<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'showLoginForm']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::post('/books/{bookId}/borrow', [BorrowController::class, 'borrowBook'])->name('books.borrow');
// Route::post('/borrows/{borrowId}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
Route::middleware(['auth'])->group(function () {
    Route::post('/books/{bookId}/borrow', [BorrowController::class, 'borrowBook'])->name('books.borrow');
    Route::post('/borrows/{borrowId}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
});

Route::get('/users/{userId}/profile', [UserController::class, 'showProfile'])->name('user.profile');
Route::get('/profile/{userId}', [ProfileController::class, 'showProfile'])->name('profile.show');

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin book management
    Route::get('/admin/books', [AdminController::class, 'manageBooks'])->name('admin.books');
    
    // View borrowed books by users
    Route::get('/admin/borrowed-books', [AdminController::class, 'viewBorrowedBooks'])->name('admin.borrowed-books');
});

Route::post('/admin/add-book', [AdminController::class, 'addBook'])->name('admin.add-book');

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');




