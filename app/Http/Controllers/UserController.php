<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index() {
        return User::all();
    } // All users

    function show($id){
        return User::find($id);
    } 


    
    public function authorAllWorks($author)
    {

        $works = DB::table('authors')
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->where('author_name', '=', $author)
            ->select('works.title')
            ->get();

        return $works;

    }

    public function mostOfferedAuthors()
    {
        $authors = Author::select('author_name', DB::raw('count(book_offers.offer_id) as thismany_books'))
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->join('book_offers', 'works.work_id', '=', 'book_offers.work')
            ->groupBy('authors.author_name')
            ->orderByDesc(DB::raw('count(book_offers.offer_id)'))
            ->limit(1) //limitálva 1re
            ->get();

        return $authors;
    }

    public function mostDemandedAuthors()
    {
        $authors = DB::table('authors')
            ->select('authors.author_name', DB::raw('count(book_demands.demand_id) as thismany_books'))
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->join('book_demands', 'works.work_id', '=', 'book_demands.work')
            ->groupBy('authors.author_name')
            ->orderByDesc(DB::raw('count(book_demands.demand_id)'))
            ->limit(1)  
            ->get();

        return response()->json($authors);
    }

    
}
