<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookOfferController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
            'publisher' => 'required|string|max:255',
            //'work' => 'required|exists:works,id',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            'book_status' => 'nullable|integer',
            //'img_url' => 'nullable|string',
            'genre_id' => 'required|exists:genres,genre_id',
            'title' => 'required|string|max:255'
        ]);

        $work = Work::firstOrCreate([ //--létezik e már
        //$work = Work::create([
            ['title' => $request->title], // Adj neki egy címet vagy más adatokat
            ['genre_id' => $request->genre_id],
        ]);

        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $request->publisher,
            'work' => $work->id,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => $request->book_status ?? 1, // Ha nincs megadva, akkor legyen 1,
            //'img_url' => 'nullable|string',
          
            //'id' => Auth::id(), // Bejelentkezett felhasználó azonosítója
        ]);

     //return response()->json([
     //   'message' => 'Könyv sikeresen hozzáadva!',
      //  'book' => $book
    //], 201);

       return response()->json($book, 201);
    }

    public function index(){
        $work=BookOffer::all(); // refers to the content of the book.
        return response()->json($work);
    }

    // USER > OFFERED BOOKS
    public function getBookOffersByUser($id) {
        $books = DB::table('book_offers')
            ->join('works', 'book_offers.work', '=', 'works.work_id') 
            ->join('publishers', 'book_offers.publishers', '=', 'publishers.publisher_id') 
            ->where('book_offers.user', '=', $id) 
            ->select('works.title', 'publishers.publisher_name', 'book_offers.book_status') 
            ->get();
    
        return response()->json($books); 
    }


}
