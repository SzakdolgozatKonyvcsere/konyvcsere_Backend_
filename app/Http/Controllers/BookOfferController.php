<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use App\Models\Work;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class BookOfferController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'user' => 'required|exists:users,id',
            'publisher' => 'required|string|max:255',
            'work_id' => 'required|exists:works,work_id',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            'book_status' => 'nullable|integer',
            //'img_url' => 'nullable|string',
            
        ]);

        $work = Work::where('work', $request->work)->first();
        

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

    public function index(){
        $work=BookOffer::all(); // refers to the content of the book.
        return response()->json($work);
    }

    // USER > OFFERED BOOKS
    public function getBookOffersByUser($id) {
        $books = DB::table('book_offers')
            ->join('works', 'book_offers.work', '=', 'works.work_id') 
            ->join('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id') 
            ->where('book_offers.user', '=', $id) 
            ->select('works.title', 'publishers.publisher_name', 'book_offers.book_status') 
            ->get();
        //Log::info('User ID:', [$id]);
        return response()->json($books); 
    }

    public function viewGetBookOffersAdmin(Request $request) {
        $page = max(1, (int) $request->query('page_number', 1)); // Pagination's default value (1st page)
        $limit = max(1, (int) $request->query('limit', 5));

        $books = DB::table('view_book_offers_admin')
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();
            
        return response()->json($books);
    }


}
