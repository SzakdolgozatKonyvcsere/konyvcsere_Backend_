<?php

namespace App\Http\Controllers;

use App\Models\ExchangeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExchangePartnerMail;
use App\Models\User;

class ExchangeHistoryController extends Controller
{
    //
    public function store(Request $request)
    {
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
            return response()->json(['message' => 'Ez a könyv már nem elérhető a cserére.'], 400);
        }

        $exchange = ExchangeHistory::create([
            'interested_user' => $request->interested_user,
            'desired_item' => $request->desired_item,
            'exchange_status' => $request->exchange_status
        ]);
        // Ha az exchange_status "k" (kérés), frissítjük a book_offers táblát
        /* if ($request->exchange_status === 'k') {
            DB::table('book_offers')
                ->where('offer_id', $request->desired_item)  // A kívánt könyv ID-ja
                ->update(['book_status' => 'f']);  // Frissítjük a book_status-t "f"-re
        } */

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
                'exchange_histories.exchange_status',
                'exchange_histories.updated_at',
                'exchange_histories.created_at'
            )
            ->get();

        return response()->json($exchanges);
    }
    //1.elfogadás
    public function patchAcceptExchange($exchange_id)
    {
        // Ellenőrizzük, hogy az ID nem NULL-e
        if (!$exchange_id) {
            return response()->json(['message' => 'Exchange ID is missing'], 400);
        }
        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::where('exchange_id', $exchange_id)->first();

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found'], 404);
        }
        // Csere állapot frissítése "folyamatban" státuszra
        $exchange->update([
            'exchange_status' => 'f'
        ]);

        // A könyv státuszát itt frissítjük "f"-re
        DB::table('book_offers')
            ->where('offer_id', $exchange->desired_item)
            ->update(['book_status' => 'f']);

        return response()->json([
            'message' => 'Exchange and book status accepted successfully to f!',
            'exchange' => $exchange
        ], 200);
    }

    // EZ A JO no1.
    /* public function patchAcceptExchange($exchange_id)
    {
         // Ellenőrizzük, hogy az ID nem NULL-e
    if (!$exchange_id) {
        return response()->json(['message' => 'Exchange ID is missing'], 400);
    }
        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::where('exchange_id', $exchange_id)->first();
        //$exchange = ExchangeHistory::find($exchange_id);
        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found'], 404);
        }
        $exchange->update([
            'exchange_status' => 'f'
        ]);

        // Csere állapot frissítése "folyamatban" státuszra
        /* $exchange->update([
            'exchange_status' => 'f' // folyamatban
        ]); 
        //$exchange->exchange_status = $request;  // Csak a státusz változik
        //$exchange->save();

        return response()->json([
            'message' => 'Exchange accepted successfully to f!',
            'exchange' => $exchange
        ], 200);
    }  */


    //másik könyv kiválasztás
    public function patchExchangeSelectOfferedBook(Request $request, $exchange_id)
    {
        $request->validate([
            'offered_item' => 'required|exists:book_offers,offer_id'
        ]);

        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::find($exchange_id);
        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found 2'], 404);
        }

        // Könyv kiválasztása
        $exchange->update([
            'offered_item' => $request->offered_item
        ]);

        DB::table('book_offers')
            ->where('offer_id', $exchange->offered_item) // vagy request->
            ->update(['book_status' => 'f']);


        return response()->json([
            'message' => 'Offered book selected successfully! 2',
            'exchange' => $exchange
        ], 200);
    }

    //2.elfogadás, teljes befejezés (a) + könyvek elcseréltek:
    public function patchAcceptExchangeFinal($exchange_id)
    {
        // Ellenőrizzük, hogy az ID nem NULL-e
        if (!$exchange_id) {
            return response()->json(['message' => 'Exchange ID is missing'], 400);
        }
        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::where('exchange_id', $exchange_id)->first();

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found'], 404);
        }
        // Csere állapot frissítése "folyamatban" státuszra
        $exchange->update([
            'exchange_status' => 'a'
        ]);

        // A könyvEK státuszát itt frissítjük "f"-re
        DB::table('book_offers')
            ->where('offer_id', $exchange->desired_item)
            ->update(['book_status' => 'e']);

        DB::table('book_offers')
            ->where('offer_id', $exchange->offered_item)
            ->update(['book_status' => 'e']);

        //Email küldés
        //Lekérjük az érdeklődő felhasználót
        $interestedUser = User::find($exchange->interested_user);


        // Lekérjük a könyv tulajdonosát
        $ownerUser = DB::table('book_offers')
            ->join('users', 'book_offers.user', '=', 'users.id')
            ->where('book_offers.offer_id', $exchange->desired_item)
            ->select('users.name', 'users.email', 'users.tel')
            ->first();

        // Küldünk e-mailt az érdeklődő felhasználónak
        if ($interestedUser && $ownerUser) {
            Mail::to($interestedUser->email)->send(new ExchangePartnerMail([
                'partner_name' => $ownerUser->name,
                'partner_email' => $ownerUser->email,
                'partner_tel' => $ownerUser->tel,
            ]));
        }
        // Küldünk e-mailt a könyv tulajdonosának
        if ($ownerUser && $interestedUser) {
            Mail::to($ownerUser->email)->send(new ExchangePartnerMail([
                'partner_name' => $interestedUser->name,
                'partner_email' => $interestedUser->email,
                'partner_tel' => $interestedUser->tel,
            ]));
        }

        return response()->json([
            'message' => 'Exchange and book status completed successfully (a + e)!',
            'exchange' => $exchange
        ], 200);
    }

    //teljes visszautasítás (v) + könyvek szabadak
    public function patchRejectExchange($exchange_id)
    {
        // Ellenőrizzük, hogy az ID nem NULL-e
        if (!$exchange_id) {
            return response()->json(['message' => 'Exchange ID is missing'], 400);
        }
        // Ellenőrizzük, hogy a csere létezik-e
        $exchange = ExchangeHistory::where('exchange_id', $exchange_id)->first();

        if (!$exchange) {
            return response()->json(['message' => 'Exchange not found'], 404);
        }
        // Csere állapot frissítése "visszautasítva" státuszra
        $exchange->update([
            'exchange_status' => 'v'
        ]);

        // A könyv státuszát itt frissítjük "s"-re
        DB::table('book_offers')
            ->where('offer_id', $exchange->desired_item)
            ->update(['book_status' => 's']);

        if ($exchange->offered_item !== null) {
            DB::table('book_offers')
                ->where('offer_id', $exchange->offered_item)
                ->update(['book_status' => 's']);
        }

        return response()->json([
            'message' => 'Exchange and book status rejected successfully (v + s + s)!',
            'exchange' => $exchange
        ], 200);
    }

    public function softDelete($id)
    {
        $record = ExchangeHistory::find($id);

        $record->exchange_status = 'x';
        $record->save();

        return response()->json(['message' => 'Sikeres törlés (soft delete).'], 200);
    }

    public function allExchangedBooksForAdmin()
    {
        $exchanges = DB::table('exchange_histories as e')
            ->join('book_offers as desired', 'e.desired_item', '=', 'desired.offer_id')
            ->join('works as desired_work', 'desired.work', '=', 'desired_work.work_id')
            ->join('users as desired_owner', 'desired.user', '=', 'desired_owner.id')

            ->leftJoin('book_offers as offered', 'e.offered_item', '=', 'offered.offer_id')
            ->leftJoin('works as offered_work', 'offered.work', '=', 'offered_work.work_id')
            ->leftJoin('users as offered_owner', 'offered.user', '=', 'offered_owner.id')

            ->where('e.exchange_status', 'a') // Csak a sikeres, befejezett cserék
            ->select([
                'e.exchange_id',
                'e.created_at',

                'desired.offer_id as desired_book_id',
                'desired_work.title as desired_book_title',
                'desired_owner.name as desired_owner_name',
                'desired_owner.email as desired_owner_email',
                'desired_owner.city as desired_owner_city',
                'desired_owner.tel as desired_owner_tel',

                'offered.offer_id as offered_book_id',
                'offered_work.title as offered_book_title',
                'offered_owner.name as offered_owner_name',
                'offered_owner.email as offered_owner_email',
                'offered_owner.city as offered_owner_city',
                'offered_owner.tel as offered_owner_tel',
            ])
            ->orderByDesc('e.created_at')
            ->get();

        return response()->json($exchanges);
    }
}
