<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookOfferController extends Controller
{

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
