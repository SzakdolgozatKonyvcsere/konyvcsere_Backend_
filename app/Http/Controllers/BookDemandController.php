<?php

namespace App\Http\Controllers;

use App\Models\BookDemand;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\Work;
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
            SELECT bd.demand_id, u.name, p.publisher_name, w.title, g.genre_name, language, min_publication_year, max_publication_year, demand_status, bd.created_at, bd.updated_at
            FROM book_demands bd
                INNER JOIN users u on u.id = bd.user
                LEFT JOIN publishers p on p.publisher_id = bd.publisher
                LEFT JOIN works w on w.work_id = bd.work
                LEFT JOIN genres g on g.genre_id = w.genre_id
            WHERE bd.user = $user_id
        ");
            
        return response()->json($book_info);
    }

    public function userUpdate(Request $request, $id)
    {        
        $validatedData = $request->validate([
            'publisher_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'language' => 'nullable|string|max:255',
            'genre_id' => 'nullable|integer|max:255',
            'min_publication_year' => 'nullable|integer|min:1700',
            'max_publication_year' => 'nullable|integer|min:1700'
        ]);

        $publisherId = null;
        if ($validatedData['publisher_name']) { // Ell. hogy van-e megadott kiadó név
            $publisher = Publisher::where('publisher_name', $validatedData['publisher_name'])->first();
        if (!$publisher) {
            $publisher = Publisher::create(['publisher_name' => $validatedData['publisher_name']]);
        }
        $publisherId = $publisher->publisher_id;
        }

        $genre = Genre::firstOrCreate(['genre_id' => $validatedData['genre_id']]);

        $work = Work::firstOrCreate(
            ['title' => $validatedData['title']],
            ['title' => $validatedData['title'], 'genre_id' => $genre->genre_id]
        );

        $bookDemand = BookDemand::where('demand_id', $id)->first();

        if (!$bookDemand) {
            return response()->json(['hiba' => 'Keresés nem található'], 404);
        }

        $bookDemand->update([
            'publisher_id' => $publisherId, 
            'work_id' => $work->id,            
            'language' => $validatedData['language'],
            'min_publication_year' => $validatedData['min_publication_year'],
            'max_publication_year' => $validatedData['max_publication_year']
        ]);
        
        return response()->json(['message' => 'Sikeresen frissítve', 'data' => $bookDemand], 200);
    }
}
