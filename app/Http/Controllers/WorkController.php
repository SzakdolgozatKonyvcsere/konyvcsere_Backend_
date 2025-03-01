<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use App\Models\Genre;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    //

    public function store(Request $request)
    { 
        $request->validate([
            'genre_id' => 'required|exists:genres,genre_id',
            'title' => 'required|string|max:255' 
        ]);
        
        $genre = Genre::where('genre_id', $request->genre_id)->first();
        if (!$genre) {
            return response()->json(['error' => 'A megadott genre_id nem található!'], 400);
        }
        //1. mű
        
    /* mű táblában van-e az adott szerző és adott könyv feltöltve. ha igen, akkor LEKÉRED A MU_ID
    h NINCS, AKKOR  létrehozol egy új mu -t új id-val. utána kéred le az mu_id
    cim alapján*/

        //$genre = Genre::find($request->genre_id);
       
    $work = Work::firstOrCreate([ //--létezik e már, vagy csinál
        //$work = Work::create([
            'genre_id' => $request->genre_id,
            'title' => $request->title, 
            
        ]);


        /*return response()->json([
            'message' => 'Mű sikeresen hozzáadva!',
            'book' => $work
        ], 201);*/


        
        // 2. könyvfeltöltés
        $request->validate([
            'user' => 'required|exists:users,id',
            'publisher' => 'required|string|max:255',
            //'work_id' => 'required|exists:works,work_id',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            'book_status' => 'nullable|integer',
            //'img_url' => 'nullable|string',
            
        ]);

        //$work = Work::where('work', $request->work)->first();
        

        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $request->publisher,
            'work_id' => $work->work_id,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => $request->book_status ?? 1, // Ha nincs megadva, akkor legyen 1,
            //'img_url' => 'nullable|string',
          
            //'id' => Auth::id(), // Bejelentkezett felhasználó azonosítója
        ]);

    return response()->json([
        'message' => 'Könyv sikeresen hozzáadva!',
        'book' => $book
    ], 201);

       //return response()->json($book, 201);
    }

}


