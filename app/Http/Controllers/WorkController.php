<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    //

    public function store(Request $request)
    {

        $request->validate([
            'genre_id' => 'required|exists:genres,genre_id',
            'title' => 'required|string|max:255' 
        ]);
    
        //$genre = Genre::find($request->genre_id);
        $genre = Genre::where('genre_id', $request->genre_id)->first();
    //$work = Work::firstOrCreate([ //--létezik e már
        $work = Work::create([
            'genre_id' => $genre->genre_id,
            'title' => $request->title, // Adj neki egy címet vagy más adatokat
            
        ]);
        return response()->json([
            'message' => 'Mű sikeresen hozzáadva!',
            'book' => $work
        ], 201);

}

}
