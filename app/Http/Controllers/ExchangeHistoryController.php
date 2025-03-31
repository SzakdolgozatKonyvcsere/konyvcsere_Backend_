<?php

namespace App\Http\Controllers;

use App\Models\ExchangeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function patchAcceptExchange($exchange_id)
    {
        //Log::info("PATCH Request received with exchange_id:", ['exchange_id' => $exchange_id]);
         // Ellenőrizzük, hogy az ID nem NULL-e
    if (!$exchange_id) {
        //Log::error("Invalid Exchange ID:", ['exchange_id' => $exchange_id]);
        return response()->json(['message' => 'Exchange ID is missing'], 400);
    }
        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::where('exchange_id', $exchange_id)->first();
        //$exchange = ExchangeHistory::find($exchange_id);
        if (!$exchange) {
            //Log::error("Exchange not found:", ['exchange_id' => $exchange_id]);
            return response()->json(['message' => 'Exchange not found'], 404);
        }
        $exchange->update([
            'exchange_status' => 'f'
        ]);

        // Csere állapot frissítése "folyamatban" státuszra
        /* $exchange->update([
            'exchange_status' => 'f' // folyamatban
        ]); */
        //$exchange->exchange_status = $request;  // Csak a státusz változik
        //$exchange->save();

        return response()->json([
            'message' => 'Exchange accepted successfully to f!',
            'exchange' => $exchange
        ], 200);
    } 

     /*public function patchAcceptExchange(Request $request, $exchange_id)
    {
        // Ellenőrzés: csak a státuszt küldheti a kliens
    $request->validate([
        'exchange_status' => 'required|in:a,k,f,v'
    ]);

    // Keresd meg az adatbázisban a megfelelő cserét
    $exchange = ExchangeHistory::find($exchange_id);

    if (!$exchange) {
        return response()->json(['message' => 'Exchange not found'], 404);
    }

    // Státusz frissítése az új értékre
    $exchange->exchange_status = $request->exchange_status;
    $exchange->save();

        return response()->json([
            'message' => 'Exchange accepted successfully to f!',
            'exchange' => $exchange
        ], 200);
    }*/ 
   /*public function patchAcceptExchange(Request $request, $exchange_id)
    {
        $validator = Validator::make($request->all(), [
            'exchange_status' => 'required|in:a,k,f,v'
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }
        $exchange = ExchangeHistory::where("exchange_id", $exchange_id)->update([
            "exchange_status" => Hash::make($request->exchange_status),
        ]);
        return response()->json(["exchange" => $exchange]);
}*/

    public function patchExchangeSelectOfferedBook(Request $request, $exchange_id)
    {
        $request->validate([
            'offered_item' => 'required|exists:book_offers,offer_id'
        ]);

        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::find($exchange_id);
        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found'], 404);
        }

        // Könyv kiválasztása
        $exchange->update([
            'offered_item' => $request->offered_item
        ]);

        return response()->json([
            'message' => 'Offered book selected successfully!',
            'exchange' => $exchange
        ], 200);
    }


}
