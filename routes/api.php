<?php

use App\Http\Controllers\BookDemandController;
use App\Http\Controllers\BookOfferController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Models\BookOffer;

use function Pest\Laravel\post;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();    
});

Route::middleware(['auth:sanctum'])->group(function () {
    //konyvfeltolteshez:
    //Route::post('/booksupload', [BookOfferController::class, 'store']);
    Route::post('/mufeltoltes', [WorkController::class, 'store']);
    //Route::post('/konyvfeltoltes', [BookOfferController::class, 'store']);
    Route::get('/genres', [GenreController::class, 'index']);
    

//Route::get('/genres', [GenreController::class, 'allGenres']);

});

Route::middleware(['auth:sanctum', Admin::class])->group(function () {

});


Route::get('/users', [UserController::class, 'index']); // all users
Route::get('/user/{id}', [UserController::class, 'show']); //retrieves a single user


Route::get('/book-offers/{id}', [BookOfferController::class, 'getBookOffersByUser']); //Given user's book offers
Route::get('/book-offers', [BookOfferController::class, 'viewGetBookOffersAdmin']); // Existing books - non-demand ones - for admin


Route::get('/book-demands', [BookDemandController::class, 'bookDemandsWithUsers']); //Books requested by users
//Route::get('/user-bookinfo/{id}', [UserController::class, 'getBookInfo']); //Given book's info

