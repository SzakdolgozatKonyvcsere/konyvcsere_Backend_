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
        $books = DB::table('konyv_kinal')
            ->join('mu', 'konyv_kinal.mu', '=', 'mu.mu_id') 
            ->join('kiado', 'konyv_kinal.kiado', '=', 'kiado.kiado_id') 
            ->where('konyv_kinal.felhasznalo', '=', $id) 
            ->select('mu.cim as konyv_cim', 'kiado.kiado_nev as kiado', 'konyv_kinal.konyv_allapot') 
            ->get();
    
        return response()->json($books); 
    }
}
