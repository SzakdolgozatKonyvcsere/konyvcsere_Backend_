<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookOfferController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'work' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            'book_status' => 'required|integer',
            //'img_url' => 'nullable|string',
        ]);

        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $request->publisher,
            'work' => $request->work,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => $request->book_status,
            //'img_url' => 'nullable|string',
          
            //'id' => Auth::id(), // Bejelentkezett felhasználó azonosítója
        ]);

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
