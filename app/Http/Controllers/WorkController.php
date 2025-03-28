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

class WorkController extends Controller
{
    public function store(Request $request)
    {
        // Validáció az adatbázisban való meglétre és a szükséges mezőkre
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
    

        // Genre validálása és keresése
        $genre = Genre::find($request->genre_id);
        if (!$genre) {
            return response()->json(['error' => 'A megadott genre_id nem található!'], 400);
        }

        // Mű (work) keresése, ha nem létezik, létrehozzuk
        $work = Work::firstOrCreate([
            'genre_id' => $request->genre_id,
            'title' => $request->title

        ]);
        // Publisher keresése vagy létrehozzuk
        $publisher = Publisher::firstOrCreate([
            'publisher_name' => $request->publisher
       
        ]);

        // Felhasználó ellenőrzése
        $user = User::find($request->user);
        if (!$user) {
            return response()->json(['error' => 'A felhasználó nem található!'], 400);
        }
        // Author (szerző) keresése vagy létrehozása
        $author = Author::firstOrCreate(['author_name' => $request->author]);

        return response()->json([
            'author' => $author,
              // Visszaadjuk az új képet
        ]);
        // Work - WrittenBy összekapcsolás (több szerző is lehet)
        WrittenBy::updateOrCreate([
            'author' => $author->author_id,
            'work' => $work->work_id
        ]);

        // Fájlkezelés, ha van kép
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/books'), $imageName);
            $imagePath = url('uploads/books/' . $imageName);
        } else {
            $imagePath = null;
        }
        /*if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');
            $validatedData['image'] = asset("storage/$path"); // Elmentjük az URL-t
        }*/

        // Könyv (BookOffer) adatainak mentése
        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $publisher->publisher_id,
            'work' => $work->work_id,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => 's', // Szabad státusz alapértelmezetten
            //'img_url' => $imagePath,
            'book_status' => 's',
            'img_url' => $imagePath,
        ]);

        return response()->json([
            'book' => $book,
            //'img_url' => $imagePath,  // Visszaadjuk az új képet
        ]);
    }
}
