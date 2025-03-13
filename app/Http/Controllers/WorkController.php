<?php

namespace App\Http\Controllers;

use App\Models\BookOffer;
use App\Models\Genre;
use App\Models\Work;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\WrittenBy;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    //

    public function store(Request $request)
    { 

        $request->validate([
            'genre_id' => 'required|exists:genres,genre_id',
            'title' => 'required|string|max:255', 
            'publisher' => 'required|string|max:255', 
            'author' => 'required|string|max:255',
            'user' => 'required|exists:users,id',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            //'img_url' => ['nullable|mimes:jpg,png,gif,jpeg,svg|max:2048'],

        ]);

        //1. work/mű feltöltés
        $genre = Genre::where('genre_id', $request->genre_id)->first();
        if (!$genre) {
            return response()->json(['error' => 'A megadott genre_id nem található!'], 400);
        }

        $work = Work::firstOrCreate([ //--létezik e már, vagy csinál
                'genre_id' => $request->genre_id,
                'title' => $request->title, 
                
            ]);

         //2. publisher/kiado feltöltés
         $publisher = Publisher::where('publisher_name', $request->publisher)->first();
         if (!$publisher) {
             $publisher = Publisher::firstOrCreate([ //--létezik e már, vagy csinál
                 'publisher_name' => $request->publisher, 
                 
         ]);
         }

        //3. author/szerzo feltöltés
        $author = Author::where('author_name', $request->author)->first();
            $author = Author::firstOrCreate([ //--létezik e már, vagy csinál
                'author_name' => $request->author, 
                
            ]);
        

        // 4. written by/írta összekapcsol
        $writtenby = WrittenBy::where('author', $author->author_id)
            ->where('work', $work->work_id)
            ->first();

        if (!$writtenby) {
            // Ha nincs ilyen kapcsolat, akkor létrehozzuk
            $writtenby = WrittenBy::updateOrCreate([
                'author' => $author->author_id,
                'work' => $work->work_id
            ]);
        }

        if (!$work->work_id) {
            return response()->json(['error' => 'work_id NULL!'], 500);
        }

        //5. könyvfeltöltés
        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $publisher->publisher_id,
            'work' => $work->work_id,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => 's', // Ha nincs megadva, akkor legyen s (szabad),
            //'img_url' => $imagePath,
            //'id' => Auth::id(), // Bejelentkezett felhasználó azonosítója
        ]); 

        return response()->json($book, 201);

        // Fájlkezelés, ha van feltöltött kép
        /*$imagePath = null;
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $file->move(public_path('uploads/books'), $imageName);
            $imagePath = url('uploads/books/' . $imageName);
        }*/
                

      
    }

}


