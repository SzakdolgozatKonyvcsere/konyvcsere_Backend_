<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookDemandController extends Controller
{
    public function bookDemandsWithUsers()
       {
           $users = DB::table('book_demands')
               ->join('user', 'book_demands.user', '=', 'user.id')
               ->join('works', 'book_demands.work', '=', 'works.work_id')
               ->select(
                   'user.id',
                   'user.full_name as name',
                   'book_demands.work as work_id',
                   'works.title'
               )
               ->get();
           return $users; // Usereket felsorolja a keresett konyveiket id-vel es cimmel
       }
}
