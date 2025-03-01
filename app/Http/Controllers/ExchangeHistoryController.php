<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeHistoryController extends Controller
{
    //
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
}
