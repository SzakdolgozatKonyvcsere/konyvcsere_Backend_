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
use function Pest\Laravel\post;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();    
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/genres', [GenreController::class, 'index']);

    Route::post('/konyvfeltoltes', [WorkController::class, 'store']); //KONYVFELTOLTES
    Route::post('/keresesfeltoltes', [BookDemandController::class, 'store']);

    Route::get('/user/{id}', [UserController::class, 'show']); //retrieves a single user
    Route::get('/all-available-books', [BookOfferController::class, 'getAllBookOffersAvailable']);
    Route::get('user/{id}/book-offers', [BookOfferController::class, 'getBookOffersByUser']); //Given user's book offers
    Route::get('/user/{id}/most-exchanged-genre', [UserController::class, 'getGivenUserMostExchangedGenre']); //E masik user profil info
    //csere:
    Route::get('/user/{id}/showinfo', [UserController::class, 'getGivenUserProfileExchangeInfo']); //??
    Route::get('/user/{id}/book-by-id', [BookOfferController::class, 'getThatBookOfferForExchange']); //E
    Route::get('/user/{id}/my-exchanges', [ExchangeHistoryController::class, 'givenUsersInExchanges']); //E
    Route::post('/exchange-request', [ExchangeHistoryController::class, 'store']); //E // cserefolyamat 0 -kezdeményezés, könyv f
    Route::patch('/user/exchange/{exchange_id}/accept', [ExchangeHistoryController::class, 'patchAcceptExchange']); //E // cserefolyamat 1 -folyamatban
    Route::patch('/user/exchange/{exchange_id}/select-book', [ExchangeHistoryController::class, 'patchExchangeSelectOfferedBook']); //E //cserefolyamat 2 -kiválaszt, másik könyv f
    Route::patch('/user/exchange/{exchange_id}/acceptfinal', [ExchangeHistoryController::class, 'patchAcceptExchangeFinal']); //E // cserefolyamat 3 -elfogad, véglegesít (a), könyvek e
    Route::patch('/user/exchange/{exchange_id}/reject', [ExchangeHistoryController::class, 'patchRejectExchange']); //E // cserefolyamat 4 -visszautasít (v), könyvek s
    //kereslet kinalat:
    Route::get('/book-demands-list', [BookDemandController::class, 'index']);
    Route::get('/book-demands-list/{demand}/matches', [BookDemandController::class, 'matches']);


// Kintrol behozva:

    //Route::get('/user-bookinfo/{id}', [UserController::class, 'getBookInfo']); //Given book's info


    Route::get('/authorworks/{author_name}', [UserController::class, 'authorAllWorks']);
    Route::get('/most-offered-authors', [UserController::class, 'mostOfferedAuthors']);
    Route::get('/most-demanded-authors', [UserController::class, 'mostDemandedAuthors']);
    Route::delete('/book-demand/{k_id}', [BookDemandController::class, 'deleteDemandedBooks']);
    Route::get('/book-demands', [BookDemandController::class, 'bookDemandsWithUsers']); //Books requested by users

    //Route::get('/user/{id}', [UserController::class, 'show']); //retrieves a single user
    Route::get('/inactive-users', [UserController::class, 'inactiveUsers']);

    Route::get('/most-exchanged-genre', [BookOfferController::class, 'mostExchangedGenre']);

    Route::get('/most-exchanged-city', [BookOfferController::class, 'mostExchangedCity']);
    Route::get('/book-quality-list', [BookOfferController::class, 'bookQualityList']);
    Route::get('/bad-quality-books', [BookOfferController::class, 'badQualityBooks']);
    Route::get('/exchanges/{user_id}', [UserController::class, 'givenUsersExchanges']);
    Route::get('/exchanges/{user_id}/{book_id}', [ExchangeHistoryController::class, 'givenUserBookExchange']);

    Route::get('/user/{user_id}/profile-info', [UserController::class, "getUserProfileInfo"]);

    Route::get('/user/{user_id}/book-offer-info', [BookOfferController::class, "getUserBookOfferInfo"]);
    Route::get('/user/{user_id}/book-demand-info', [BookDemandController::class, "getUserBookDemandInfo"]);
    Route::post('/user/update-profile-picture', [UserController::class, 'updateProfilePicture']);
    Route::put('/user/{id}/update-info', [UserController::class, "update"]);

    Route::put('/book-demands/{id}/user-update', [BookDemandController::class, 'userUpdate']);
    Route::put('/book-offers/{id}/user-update', [BookOfferController::class, 'userUpdate']);

    Route::patch("/soft-delete/{id}/book-demand", [BookDemandController::class, "softDelete"]);
    Route::patch("/soft-delete/{id}/book-offer", [BookOfferController::class, "softDelete"]);
    Route::patch("/soft-delete/{id}/exchange", [ExchangeHistoryController::class, "softDelete"]);
});

Route::middleware(['auth:sanctum', Admin::class])->group(function () {
    // all users
    Route::get('/book-offers', [BookOfferController::class, 'viewGetBookOffersAdmin']); // Existing books - non-demand ones - for admin
    Route::get('/users', [UserController::class, 'index']);
    Route::patch('/users/{id}/change-role', [UserController::class, "adminRoleChange"]);
});


Route::get('/new-book-offers', [BookOfferController::class, 'newBookOffers']); // vendegeknek kezdolapra
Route::get('/exchanged-books', [ExchangeHistoryController::class, 'allExchangedBooksForAdmin']); //összes cserefolyamat adminnak


