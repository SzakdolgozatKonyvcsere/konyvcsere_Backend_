<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookOfferController;
use App\Http\Middleware\Admin;
use App\Models\BookOffer;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();    
});


Route::middleware(['auth:sanctum'])->group(function () {

});

Route::middleware(['auth:sanctum', Admin::class])->group(function () {
    Route::get('/admin/users', [UserController::class, 'getUsers']);
});

Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/user/{id}', [UserController::class, 'getUser']);

Route::get('/user/{id}/mu', [BookOfferController::class, 'getBooksForUsers']);
Route::get('/user-offers/{id}', [UserController::class, 'getUsersBookOffers']); //Given user's book offers

Route::get('/book-requests', [UserController::class, 'requestedBooks']); //Books requested by users
Route::get('/user-bookinfo/{id}', [UserController::class, 'getBookInfo']); //Given book's info

Route::get('/books', [BookOfferController::class, 'getBooks']);
