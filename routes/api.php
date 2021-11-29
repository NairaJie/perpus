<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\AuthorController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register', [UserController::class, 'registerUser']);
Route::post('login', [UserController::class, 'loginUser']);
Route::post('logout', [UserController::class, 'logoutUser']);
Route::get('user/get/{id}', [UserController::class, 'getUser']);
Route::post('user/update/{id}', [UserController::class, 'updateUser']);
Route::delete('user/delete/{id}', [UserController::class, 'deleteUser']);

Route::get('books/get/{id}', [BookController::class, 'readBook']);
Route::post('books/create', [BookController::class, 'createBook']);
Route::post('books/update/{id}', [BookController::class, 'updateBook']);
Route::delete('books/delete/{id}', [BookController::class, 'deleteBook']);

Route::get('authors/get/{id}', [AuthorController::class, 'getAuthor']);
Route::post('authors/create', [AuthorController::class, 'createAuthor']);
Route::post('authors/update/{id}', [AuthorController::class, 'updateAuthor']);
Route::delete('authors/delete/{id}', [AuthorController::class, 'deleteAuthor']);

Route::get('publisher/get/{id}', [PublisherController::class, 'readPublisher']);
Route::post('publisher/create', [PublisherController::class, 'createPublisher']);
Route::post('publisher/update/{id}', [PublisherController::class, 'updatePublisher']);
Route::delete('publisher/delete/{id}', [PublisherController::class, 'deletePublisher']);

Route::get('borrow/get/{id}', [BorrowController::class, 'getBorrow']);
Route::post('borrow/create', [BorrowController::class, 'createBorrow']);
Route::post('borrow/update/{id}', [BorrowController::class, 'updateBorrow']);
Route::delete('borrow/delete/{id}', [BorrowController::class, 'deleteBorrow']);
