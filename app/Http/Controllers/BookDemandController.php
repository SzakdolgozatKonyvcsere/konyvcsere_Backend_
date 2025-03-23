<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookDemandController extends Controller
{
    public function bookDemandsWithUsers()
       {
           $users = DB::table('book_demands')
               ->join('users', 'book_demands.user', '=', 'users.id')
               ->join('works', 'book_demands.work', '=', 'works.work_id')
               ->select(
                   'users.id',
                   'users.name as name',
                   'book_demands.work as work_id',
                   'works.title'
               )
               ->orderBy('users.name')
               ->get();

           return $users; // Usereket felsorolja a keresett konyveiket id-vel es cimmel
       }


       public function deleteDemandedBooks($k_id)
       {
           $deleted = DB::table('book_demands')
               ->where('demand_id', $k_id)
               ->delete();

           return $deleted;
       }

       public function getUserBookDemandInfo($user_id){
        $book_info = DB::select("
            SELECT u.name, p.publisher_name, w.title, g.genre_name, language, min_publication_year, max_publication_year, demand_status, bd.created_at, bd.updated_at
            FROM book_demands bd
                INNER JOIN users u on u.id = bd.user
                INNER JOIN publishers p on p.publisher_id = bd.publisher
                INNER JOIN works w on w.work_id = bd.work
                INNER JOIN genres g on g.genre_id = w.genre_id
            WHERE bd.user = $user_id
        ");
            
        return response()->json($book_info);
    }
}
