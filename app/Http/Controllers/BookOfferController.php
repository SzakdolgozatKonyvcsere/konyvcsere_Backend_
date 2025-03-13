<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use App\Models\ExchangeHistory;
use App\Models\Work;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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
            ->join('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id') 
            ->where('book_offers.user', '=', $id) 
            ->select('works.title', 'publishers.publisher_name', 'book_offers.book_status') 
            ->get();

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

    public function mostExchangedGenre()
    {
        $mufaj = DB::table('exchange_histories as c')
            ->select('g.genre_name', DB::raw('count(c.exchange_id) as exchange_number'))
            ->join('book_offers as bk', 'c.desired_item', '=', 'bk.offer_id')
            ->join('works as w', 'bk.work', '=', 'w.work_id')
            ->join('genres as g', 'w.genre_id', '=', 'g.genre_id')
            ->where('c.exchange_status', 'függőben') 
            ->groupBy('g.genre_name')
            ->orderByDesc(DB::raw('count(c.exchange_id)'))
            ->limit(1) 
            ->get();

        return response()->json($mufaj);
    }

    public function mostExchangedCity()
    {
        $city = DB::table('exchange_histories as c')
            ->select('u.city', DB::raw('count(c.exchange_id) as exchange_number'))
            ->join('users as u', 'c.interested_user', '=', 'u.id')
            ->where('c.exchange_status', 'függőben') 
            ->groupBy('u.city')
            ->orderByDesc(DB::raw('count(c.exchange_id)'))
            ->limit(1)
            ->get();

        return response()->json($city);
    }


    public function bookQualityList()
    {
        $books = BookOffer::select('offer_id', 'user', 'publisher', 'work', 'language', 
        'publication_year', 'quality', 'book_status')
            ->where('quality', '>=', 4);

        return response()->json($books);
    }

    public function badQualityBooks()
    {
        $books = BookOffer::select('offer_id', 'user', 'publisher', 'work', 'language', 
        'publication_year', 'quality', 'book_status')
        ->where('quality', '<', 4);

        return response()->json($books);
    }

    public function getUserBookOfferInfo($user_id){
        $book_info = DB::select("
            SELECT u.name, p.publisher_name, w.title, g.genre_name, language, publication_year, quality, book_status
            FROM book_offers bo
                INNER JOIN users u on u.id = bo.user
                INNER JOIN publishers p on p.publisher_id = bo.publisher
                INNER JOIN works w on w.work_id = bo.work
                INNER JOIN genres g on g.genre_id = w.genre_id
            WHERE bo.user = $user_id
        ");
            
        return response()->json($book_info);
    }

    

}
