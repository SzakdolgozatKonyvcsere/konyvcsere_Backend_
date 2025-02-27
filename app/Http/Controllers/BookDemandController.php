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
}
