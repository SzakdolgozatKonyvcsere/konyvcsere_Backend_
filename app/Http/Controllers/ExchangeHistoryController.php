<?php

namespace App\Http\Controllers;

use App\Models\ExchangeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeHistoryController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'interested_user' => 'required|exists:users,id',
            'desired_item' => 'required|exists:book_offers,offer_id',
            'exchange_status' => 'required|in:a,k,f,v' 
        ]);

        // Ellenőrizzük, hogy a kívánt könyv státusza "f"-e (nem elérhető)
        $book = DB::table('book_offers')
        ->where('offer_id', $request->desired_item)
        ->first();

        if ($book && $book->book_status === 'f') {
            return response()->json(['message' => 'This book is no longer available for exchange.'], 400);
        }

        $exchange = ExchangeHistory::create([
            'interested_user' => $request->interested_user,
            'desired_item' => $request->desired_item,
            'exchange_status' => $request->exchange_status
        ]);
        // Ha az exchange_status "k" (kérés), frissítjük a book_offers táblát
        if ($request->exchange_status === 'k') {
            DB::table('book_offers')
                ->where('offer_id', $request->desired_item)  // A kívánt könyv ID-ja
                ->update(['book_status' => 'f']);  // Frissítjük a book_status-t "f"-re
        }

        return response()->json([
            'message' => 'Exchange request sent successfully!',
            'exchange' => $exchange,
        ], 201);
    }

    public function givenUserBookExchange($user_id, $book_id)
    {
        $exchanges = DB::table('exchange_histories')
            ->join('users', 'users.id', '=', 'exchange_histories.interested_user')
            ->join('book_offers', 'book_offers.offer_id', '=', 'exchange_histories.desired_item')
            ->where('users.id', $user_id)
            ->where('exchange_histories.desired_item', $book_id)
            ->select('exchange_histories.*')
            ->get();

        return response()->json($exchanges);
    }

    public function givenUsersInExchanges($user_id)
    {
        $exchanges = DB::table('exchange_histories')
            ->leftJoin('book_offers as desired_book', 'exchange_histories.desired_item', '=', 'desired_book.offer_id')
            ->leftJoin('users as desired_book_owner', 'desired_book.user', '=', 'desired_book_owner.id')
            ->leftJoin('book_offers as offered_book', 'exchange_histories.offered_item', '=', 'offered_book.offer_id')

            ->where('exchange_histories.interested_user', $user_id)
            ->orWhere('desired_book.user', $user_id)

            ->select(
                'exchange_histories.exchange_id',
                'exchange_histories.interested_user as interested_user_id',
                'desired_book.user as desired_book_owner_id',
                'exchange_histories.desired_item as desired_book_id',
                'exchange_histories.offered_item as offered_book_id',
                'exchange_histories.exchange_status'
            )
            ->get();

        return response()->json($exchanges);
    }
}
