<?php

use Illuminate\Support\Facades\Auth;
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
    Route::delete('/books/delete/{id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/edit/{id}', [App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/update', [App\Http\Controllers\BookController::class, 'update'])->name('books.update');
    Route::post('/add/books', [App\Http\Controllers\BookController::class, 'store'])->name('books.store');

    Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}', [App\Http\Controllers\AuthorController::class, 'show']);
    Route::get('/authors/edit/{id}', [App\Http\Controllers\AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/authors/update', [App\Http\Controllers\AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/delete', [App\Http\Controllers\AuthorController::class, 'delete'])->name('authors.delete');
    Route::post('/add/authors', [App\Http\Controllers\AuthorController::class, 'store'])->name('authors.store');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});
