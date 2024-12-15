<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::get('change', [LanguageController::class, 'change'])->name('lang.change');

    // Admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Users
        Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.viewUsers');
        Route::patch('/admin/users/{id}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
        Route::delete('/admin/users/{id}', [UserController::class, 'delete'])->name('users.delete');
        // Reviews
        Route::get('/admin/reviews', [AdminController::class, 'viewReviews'])->name('admin.viewReviews');
        Route::delete('/admin/reviews/{id}', [AdminController::class, 'deleteReview'])->name('reviews.delete');
        // Books
        Route::get('/admin/books', [AdminController::class, 'viewBooks'])->name('admin.viewBooks');
        Route::delete('/admin/books/{id}', [BookController::class, 'delete'])->name('books.delete');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Books
    Route::get('/uploadbooks', [BookController::class, 'index'])->name('upload.books');
    Route::patch('/uploadimages', [BookController::class, 'store'])->name('store.book');
    Route::get('/mybooks', [BookController::class, 'myBooks'])->name('view.mybooks');
    Route::get('/allbooks', [BookController::class, 'allBooks'])->name('view.allbooks');
    Route::delete('/deletebook/{id}', [BookController::class, 'delete'])->name('delete.book');
    Route::get('/books/{id}', [BookController::class, 'details'])->name('view.book');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('update.book');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('edit.book');

    // Reviews
    Route::get('/books/{id}/review', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/books/{id}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/reviews/{id}', [ReviewController::class, 'details'])->name('review.details');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Comments
    Route::get('/reviews/{review}/comments/create', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('comment.store');



    // Route::get('/userdetails/{id}', [UserController::class, 'index'])->name('user.details');
});

require __DIR__ . '/auth.php';
