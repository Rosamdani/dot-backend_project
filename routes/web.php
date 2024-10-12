<?php

use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login/auth', [App\Http\Controllers\AuthController::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [App\Http\Controllers\BookController::class, 'show']);
    Route::post('/add/books', [App\Http\Controllers\BookController::class, 'store'])->name('books.store');

    Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}', [App\Http\Controllers\AuthorController::class, 'show']);
    Route::post('/add/authors', [App\Http\Controllers\AuthorController::class, 'store'])->name('authors.store');
});
