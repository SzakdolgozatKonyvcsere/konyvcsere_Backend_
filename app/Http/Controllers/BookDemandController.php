<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookDemand;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookDemandController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'user' => 'required|integer|exists:users,id',
            'publisher_name' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'genre_id' => 'exists:genres,genre_id',
            'authors' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'min_publication_year' => 'required|integer|min:1700',
            'max_publication_year' => 'required|integer|max:' . date('Y'),
        ]);

        $publisher = Publisher::firstOrCreate(
            ['publisher_name' => $validatedData["publisher_name"]]
        );

        $work = Work::firstOrCreate([
            'title' => $validatedData['title'],
            'genre_id' => $validatedData['genre_id'],
        ]);
        $authors = array_map('trim', explode(',', $validatedData['authors']));
        $authorIds = [];
        foreach ($authors as $authorName) {
            if ($authorName === '') continue; // véd a ", "-től
            $author = Author::firstOrCreate(['author_name' => $authorName]);
            $authorIds[] = $author->author_id;
        }
        $work->authors()->sync($authorIds);

        $bookDemand = BookDemand::create([
            'user' => $validatedData['user'],
            'publisher' => $publisher->publisher_id,
            'work' => $work->work_id,
            'language' => $validatedData['language'],       
            'min_publication_year' => $validatedData['min_publication_year'],
            'max_publication_year' => $validatedData['max_publication_year']
        ]);

        return response()->json([
            'message' => 'Könyv keresés sikeresen feltöltve!',
            'data' => $bookDemand,
        ], 201);
    }

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
            SELECT bd.demand_id, u.name, p.publisher_name, w.title, g.genre_name, 
                (
                    SELECT GROUP_CONCAT(a.author_name SEPARATOR ', ')
                    FROM written_bies wb
                    INNER JOIN authors a ON a.author_id = wb.author
                    WHERE wb.work = w.work_id
                ) AS authors,
                language, min_publication_year, max_publication_year, demand_status, bd.created_at, bd.updated_at
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
            'genre_id' => 'required|integer|max:255|exists:genres,genre_id',
            'authors' => 'nullable|string|max:255', // written by-n keresztul
            'language' => 'nullable|string|max:255',
            'min_publication_year' => 'required|integer|min:1700',
            'max_publication_year' => 'required|integer|max:' . date('Y')
        ]);

        $publisher = Publisher::firstOrCreate(
            ['publisher_name' => $validatedData["publisher_name"]]
        );

        $genre = Genre::where('genre_id', $validatedData['genre_id'])->first();
        if (!$genre) {
            return response()->json(['hiba' => 'Műfaj nem található'], 400);
        }
        
        $work = Work::firstOrCreate([
            'title' => $validatedData['title'],
            'genre_id' => $validatedData['genre_id'],
        ]);
        $authors = array_map('trim', explode(',', $validatedData['authors']));
        $authorIds = [];
        foreach ($authors as $authorName) {
            if ($authorName === '') continue; // véd a ", "-től
            $author = Author::firstOrCreate(['author_name' => $authorName]);
            $authorIds[] = $author->author_id;
        }
        $work->authors()->sync($authorIds); // replacelunk, nem csak addolunk
        // szerzőt a műhöz csatoljuk
        // syncWD: duplikálást elkerülve megtartja az előző szerzőket - kell hozzá belongstomany a modelben

        $bookDemand = BookDemand::where('demand_id', $id)->first();
        if (!$bookDemand) {
            return response()->json(['hiba' => 'Keresés nem található'], 404);
        }

        $bookDemand->update([
            'publisher' => $publisher->publisher_id, 
            'work' => $work->work_id, 
            'language' => $validatedData['language'],       
            'min_publication_year' => $validatedData['min_publication_year'],
            'max_publication_year' => $validatedData['max_publication_year']
        ]);
        
        return response()->json(['message' => 'Sikeresen frissítve', 'data' => $bookDemand], 200);
    }

    public function softDelete($id) {
        $record = BookDemand::find($id);

        $record->demand_status = 'x';
        $record->save();

        return response()->json(['message' => 'Sikeres törlés (soft delete).'], 200);
    }
}
