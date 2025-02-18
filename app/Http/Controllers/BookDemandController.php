<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookDemandController extends Controller
{
    public function bookDemands()
       {
           $users = DB::table('konyv_keres')
               ->join('user', 'konyv_keres.user', '=', 'user.id')
               ->join('mu', 'konyv_keres.mu', '=', 'mu.mu_id')
               ->select(
                   'user.id',
                   'user.teljes_nev as name',
                   'konyv_keres.mu as mu_id',
                   'mu.cim as mu_cim'
               )
               ->get();
           return $users; // Usereket felsorolja a keresett konyveiket id-vel es cimmel
       }
}
