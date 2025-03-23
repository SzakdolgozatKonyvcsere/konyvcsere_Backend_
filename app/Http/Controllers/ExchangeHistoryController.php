<?php

namespace App\Http\Controllers;


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

        $exchange = ExchangeHistory::create([
            'interested_user' => $request->interested_user,
            'desired_item' => $request->desired_item,
            'exchange_status' => $request->exchange_status
        ]);

        return response()->json(['message' => 'Exchange request sent successfully!'], 201);
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
}
