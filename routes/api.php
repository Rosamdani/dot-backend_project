<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/books', App\Http\Controllers\Api\BooksController::class);
Route::apiResource('/author', App\Http\Controllers\Api\AuthorController::class);
Route::get('/search/books', [App\Http\Controllers\Api\BooksController::class, 'search']);
