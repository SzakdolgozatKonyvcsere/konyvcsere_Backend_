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
        
        //1. mű
        
    /* mű táblában van-e az adott szerző és adott könyv feltöltve. ha igen, akkor LEKÉRED A MU_ID
    h NINCS, AKKOR  létrehozol egy új mu -t új id-val. utána kéred le az mu_id
    cim alapján*/
    $request->validate([
        'genre_id' => 'required|exists:genres,genre_id',
        'title' => 'required|string|max:255' 
    ]);
    
    $genre = Genre::where('genre_id', $request->genre_id)->first();
    if (!$genre) {
        return response()->json(['error' => 'A megadott genre_id nem található!'], 400);
    }


    $work = Work::firstOrCreate([ //--létezik e már, vagy csinál
        //$work = Work::create([
            'genre_id' => $request->genre_id,
            'title' => $request->title, 
            
        ]);


    //2. publisher feltöltés
        $request->validate([
            'publisher' => 'required|string|max:255' 
        ]);
        $publisher = Publisher::where('publisher_name', $request->publisher)->first();
        if (!$publisher) {
            
            $publisher = Publisher::firstOrCreate([ //--létezik e már, vagy csinál
           
                //'publisher_id' => $request->genre_id,
                'publisher_name' => $request->publisher, 
                
        ]);
        }

       
    //3. szerzo feltöltés
         $request->validate([
            //'publisher_id' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            //'work_id' => 'required|exists:works,work_id'
        ]);
        $author = Author::where('author_name', $request->author)->first();
        
        if (!$author) {
            
            $author = Author::firstOrCreate([ //--létezik e már, vagy csinál
           
                //'publisher_id' => $request->genre_id,
                'author_name' => $request->author, 
                
            ]);
        
        }

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
      
        




        // . könyvfeltöltés
        $request->validate([
            'user' => 'required|exists:users,id',
            //'publisher' => 'required|exists:publisher,publisher_name',
            //'work_id' => 'required|exists:works,work_id',
            'language' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'quality' => 'required|integer',
            //'book_status' => 'nullable|integer',
            'img_url' => ['nullable|mimes:jpg,png,gif,jpeg,svg|max:2048'],
            
        ]);

        // Fájlkezelés, ha van feltöltött kép
        $imagePath = null;
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $file->move(public_path('uploads/books'), $imageName);
            $imagePath = url('uploads/books/' . $imageName);
        }

        //$work = Work::where('work', $request->work)->first();
        

        $book = BookOffer::create([
            'user' => $request->user,
            'publisher' => $publisher->publisher_id,
            'work' => $work->work_id,
            'language' => $request->language,
            'publication_year' => $request->publication_year,
            'quality' => $request->quality,
            'book_status' => 1, // Ha nincs megadva, akkor legyen 1,
            'img_url' => $imagePath,
          
            //'id' => Auth::id(), // Bejelentkezett felhasználó azonosítója
        ]); 

         // MINDEN KÉSZ, EGYETLEN RETURN JSON
 /*    return response()->json([
        'message' => 'Sikeresen mentve!',
        'work' => $work,
        'publisher' => $publisher,
        'author' => $author,
        'writtenby' => $writtenby,
        'book' => $book
    ], 201); */

  

       return response()->json($book, 201);
    }

}


