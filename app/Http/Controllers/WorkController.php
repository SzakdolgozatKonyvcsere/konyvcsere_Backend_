<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use App\Models\Genre;
use App\Models\Work;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\User;
use App\Models\WrittenBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    public function store(Request $request)
    {
        // Validáció
        $request->validate([
            'genre_id' => 'required|exists:genres,genre_id',
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'user' => 'required|exists:users,id',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            'img_url' => ['nullable', 'mimes:jpg,png,gif,jpeg,svg', 'max:5120'],
        ]);

        $genre = Genre::find($request->genre_id);

        $work = Work::firstOrCreate([
            'genre_id' => $genre->genre_id,
            'title' => $request->title,
        ]);


        // Publisher keresése vagy létrehozzuk
        $publisher = Publisher::firstOrCreate(['publisher_name' => $request->publisher]);

        // A szerző és kép kezelése
        $author = Author::firstOrCreate(['author_name' => $request->author]);

        // Fájlkezelés, ha van kép
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('books_pictures'), $imageName);
            $imagePath = 'books_pictures/' . $imageName;
        } else {
            $imagePath = null;
        }

        // Kapcsolat létrehozása a szerző és a mű között
        DB::table('written_bies')->updateOrInsert([
            'author' => $author->author_id,
            'work' => $work->work_id,
        ]);

        // Könyv (BookOffer) adatainak mentése
        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $publisher->publisher_id,
            'work' => $work->work_id,
            'author' => $author->author_id,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => 's', // Szabad státusz alapértelmezetten 
            'img_url' => $imagePath,
        ]);

        return response()->json([
            'book' => $book,
        ]);
    }
}
