<?php

use App\Http\Controllers\BookDemandController;
use App\Http\Controllers\BookOfferController;
use App\Http\Controllers\ExchangeHistoryController;
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
    //KONYVFELTOLTES:
    //Route::post('/booksupload', [BookOfferController::class, 'store']);
    //Route::post('/mufeltoltes', [WorkController::class, 'store']);
    Route::post('/konyvfeltoltes', [WorkController::class, 'store']);
    Route::get('/genres', [GenreController::class, 'index']);

});

Route::middleware(['auth:sanctum', Admin::class])->group(function () {

});







Route::get('/book-offers', [BookOfferController::class, 'viewGetBookOffersAdmin']); // Existing books - non-demand ones - for admin



//Route::get('/user-bookinfo/{id}', [UserController::class, 'getBookInfo']); //Given book's info


Route::get('/authorworks/{author_name}', [UserController::class, 'authorAllWorks']);
Route::get('/most-offered-authors', [UserController::class, 'mostOfferedAuthors']);
Route::get('/most-demanded-authors', [UserController::class, 'mostDemandedAuthors']);
Route::delete('/book-demand/{k_id}', [BookDemandController::class, 'deleteDemandedBooks']);
Route::get('/book-demands', [BookDemandController::class, 'bookDemandsWithUsers']); //Books requested by users
Route::get('/book-offers/{id}', [BookOfferController::class, 'getBookOffersByUser']); //Given user's book offers
Route::get('/users', [UserController::class, 'index']); // all users
Route::get('/user/{id}', [UserController::class, 'show']); //retrieves a single user
Route::get('/inactive-users', [UserController::class, 'inactiveUsers']);
Route::get('/most-exchanged-genre', [BookOfferController::class, 'mostExchangedGenre']);
Route::get('/most-exchanged-city', [BookOfferController::class, 'mostExchangedCity']);
Route::get('/book-quality-list', [BookOfferController::class, 'bookQualityList']);
Route::get('/bad-quality-books', [BookOfferController::class, 'badQualityBooks']);
Route::get('/exchanges/{user_id}', [UserController::class, 'givenUsersExchanges']);
Route::get('/exchanges/{user_id}/{book_id}', [ExchangeHistoryController::class, 'givenUserBookExchange']);
Route::get('/all-available-books', [BookOfferController::class, 'getAllBookOffersAvailable']);
Route::get('/user-profile-info/{user_id}', [UserController::class, "getUserProfileInfo"]);
Route::get('/user-book-offer-info/{user_id}', [BookOfferController::class, "getUserBookOfferInfo"]);
Route::get('/user-book-demand-info/{user_id}', [BookDemandController::class, "getUserBookDemandInfo"]);
Route::post('/user/update-profile-picture', [UserController::class, 'updateProfilePicture']);

