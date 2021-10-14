<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/author/{author}', [AuthorController::class, 'show']);
Route::post('/author/create', [AuthorController::class, 'store']);
Route::put('/author/update/{author}', [AuthorController::class, 'update']);
Route::delete('/author/delete/{author}', [AuthorController::class, 'destroy']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{book}', [BookController::class, 'show']);
Route::post('/book/create', [BookController::class, 'store']);
Route::put('/book/update/{book}', [BookController::class, 'update']);
Route::delete('/book/delete/{book}', [BookController::class, 'destroy']);