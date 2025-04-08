<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookOffer;
use App\Models\ExchangeHistory;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\Work;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class BookOfferController extends Controller
{

    public function index()
    {
        $work = BookOffer::all(); // refers to the content of the book.
        return response()->json($work);
    }

    // USER > OFFERED BOOKS
    public function getBookOffersByUser($id)
    {
        $books = DB::table('book_offers')
            ->leftJoin('works', 'book_offers.work', '=', 'works.work_id')
            ->leftJoin('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id')
            ->leftJoin('written_bies', 'works.work_id', '=', 'written_bies.work')
            ->leftJoin('authors', 'written_bies.author', '=', 'authors.author_id')
            ->leftJoin('genres', 'works.genre_id', '=', 'genres.genre_id')
            ->leftJoin('users', 'book_offers.user', '=', 'users.id')
            ->where(function ($query) use ($id) {
                $query->whereIn('book_offers.book_status', ['s', 'f'])
                    ->where('book_offers.user', '=', $id);
            })  // Csak azok a könyvek, amiket ő töltött fel
            ->select(
                'book_offers.img_url',
                'users.id',
                'book_offers.offer_id',
                'works.title',
                'publishers.publisher_name',
                'book_offers.book_status',
                DB::raw('GROUP_CONCAT(authors.author_name SEPARATOR ", ") as authors'),
                'book_offers.publication_year',
                'book_offers.language',
                'book_offers.quality',
                'book_offers.user',
                'genres.genre_name'
            )
            ->groupBy(
                'book_offers.img_url',
                'users.id',
                'book_offers.offer_id',
                'works.title',
                'publishers.publisher_name',
                'book_offers.book_status',
                'book_offers.publication_year',
                'book_offers.language',
                'book_offers.quality',
                'book_offers.user',
                'genres.genre_name'
            )
            ->get();

        return response()->json($books);
    }

    public function viewGetBookOffersAdmin(Request $request)
    {
        $page = max(1, (int) $request->query('page_number', 1)); // Pagination's default value (1st page)
        $limit = max(1, (int) $request->query('limit', 5));

        $books = DB::table('view_book_offers_admin')
            ->offset(($page - 1) * $limit)
            ->limit($limit)
            ->get();

        return response()->json($books);
    }

    public function mostExchangedGenre()
    {
        $mufaj = DB::table('exchange_histories as c')
            ->select('g.genre_name', DB::raw('count(c.exchange_id) as exchange_number'))
            ->join('book_offers as bk', 'c.desired_item', '=', 'bk.offer_id')
            ->join('works as w', 'bk.work', '=', 'w.work_id')
            ->join('genres as g', 'w.genre_id', '=', 'g.genre_id')
            ->where('c.exchange_status', 'függőben')
            ->groupBy('g.genre_name')
            ->orderByDesc(DB::raw('count(c.exchange_id)'))
            ->limit(1)
            ->get();

        return response()->json($mufaj);
    }

    public function mostExchangedCity()
    {
        $city = DB::table('exchange_histories as c')
            ->select('u.city', DB::raw('count(c.exchange_id) as exchange_number'))
            ->join('users as u', 'c.interested_user', '=', 'u.id')
            ->where('c.exchange_status', 'függőben')
            ->groupBy('u.city')
            ->orderByDesc(DB::raw('count(c.exchange_id)'))
            ->limit(1)
            ->get();

        return response()->json($city);
    }


    public function bookQualityList()
    {
        $books = BookOffer::select(
            'offer_id',
            'user',
            'publisher',
            'work',
            'language',
            'publication_year',
            'quality',
            'book_status'
        )
            ->where('quality', '>=', 4);

        return response()->json($books);
    }

    public function badQualityBooks()
    {
        $books = BookOffer::select(
            'offer_id',
            'user',
            'publisher',
            'work',
            'language',
            'publication_year',
            'quality',
            'book_status'
        )
            ->where('quality', '<', 4);

        return response()->json($books);
    }

    public function getAllBookOffersAvailable(Request $request) {
        $userId = $request->user()->id;  // Az aktuális felhasználó ID-ja
        $books = DB::table('book_offers')
            ->leftJoin('works', 'book_offers.work', '=', 'works.work_id') 
            ->leftJoin('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id') 
            ->leftJoin('written_bies', 'works.work_id', '=', 'written_bies.work')
            ->leftJoin('authors', 'written_bies.author', '=', 'authors.author_id')
            ->leftJoin('genres', 'works.genre_id', '=', 'genres.genre_id')
            ->leftJoin('users', 'book_offers.user', '=', 'users.id')
            ->where(function ($query) use ($userId) {
                //$query->whereIn('book_offers.book_status', ['s', 'f'])
                $query->whereIn('book_offers.book_status', ['s'])
                      ->where('book_offers.user', '!=', $userId);
            })  // Csak azok a könyvek, amiket nem ő töltött fel
            ->select('book_offers.img_url', 'users.id', 'book_offers.offer_id', 'works.title', 'publishers.publisher_name', 'book_offers.book_status', 
            DB::raw('GROUP_CONCAT(authors.author_name SEPARATOR ", ") as authors'), 
            'book_offers.publication_year', 'book_offers.language', 'book_offers.quality', 'book_offers.user', 'genres.genre_name') 
            ->groupBy('book_offers.img_url', 'users.id', 'book_offers.offer_id', 'works.title', 'publishers.publisher_name', 
              'book_offers.book_status', 'book_offers.publication_year', 
              'book_offers.language', 'book_offers.quality', 'book_offers.user', 'genres.genre_name')
            ->get();
    
        return response()->json($books); 
    }
/*public function getAllBookOffersAvailable(Request $request) {
    $userId = $request->user()->id;  // Az aktuális felhasználó ID-ja
    $books = DB::table('book_offers')
        ->leftJoin('works', 'book_offers.work', '=', 'works.work_id') 
        ->leftJoin('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id') 
        ->leftJoin('written_bies', 'works.work_id', '=', 'written_bies.work')
        ->leftJoin('authors', 'written_bies.author', '=', 'authors.author_id')
        ->leftJoin('genres', 'works.genre_id', '=', 'genres.genre_id')
        ->leftJoin('users', 'book_offers.user', '=', 'users.id')
        ->where(function ($query) use ($userId) {
            //$query->whereIn('book_offers.book_status', ['s', 'f'])
            $query->whereIn('book_offers.book_status', ['s'])
                  ->where('book_offers.user', '!=', $userId);
        })  // Csak azok a könyvek, amiket nem ő töltött fel
        ->select('book_offers.img_url', 'users.id', 'book_offers.offer_id', 'works.title', 'publishers.publisher_name', 'book_offers.book_status', 
        DB::raw('GROUP_CONCAT(authors.author_name SEPARATOR ", ") as authors'), 
        'book_offers.publication_year', 'book_offers.language', 'book_offers.quality', 'book_offers.user', 'genres.genre_name') 
        ->groupBy('book_offers.img_url', 'users.id', 'book_offers.offer_id', 'works.title', 'publishers.publisher_name', 
          'book_offers.book_status', 'book_offers.publication_year', 
          'book_offers.language', 'book_offers.quality', 'book_offers.user', 'genres.genre_name')
        ->get();
        return response()->json($books);
    }*/

     /* public function getAllBookOffersAvailable(Request $request)
    {
        $userId = $request->user()->id;  // Az aktuális felhasználó ID-ja
        $books = DB::table('book_offers')
            ->leftJoin('works', 'book_offers.work', '=', 'works.work_id')
            ->leftJoin('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id')
            ->leftJoin('written_bies', 'works.work_id', '=', 'written_bies.work')
            ->leftJoin('authors', 'written_bies.author', '=', 'authors.author_id')
            ->leftJoin('genres', 'works.genre_id', '=', 'genres.genre_id')
            ->leftJoin('users', 'book_offers.user', '=', 'users.id')
            ->where(function ($query) use ($userId) {
                $query->whereIn('book_offers.book_status', ['s'])
                    ->where('book_offers.user', '!=', $userId);
            })  // Csak azok a könyvek, amiket nem ő töltött fel
            ->select(
                'book_offers.img_url',
                'users.id',
                'book_offers.offer_id',
                'works.title',
                'publishers.publisher_name',
                'book_offers.book_status',
                DB::raw('GROUP_CONCAT(authors.author_name SEPARATOR ", ") as authors'),
                'book_offers.publication_year',
                'book_offers.language',
                'book_offers.quality',
                'book_offers.user',
                'genres.genre_name'
            )
            ->groupBy(
                'book_offers.img_url',
                'users.id',
                'book_offers.offer_id',
                'works.title',
                'publishers.publisher_name',
                'book_offers.book_status',
                'book_offers.publication_year',
                'book_offers.language',
                'book_offers.quality',
                'book_offers.user',
                'genres.genre_name'
            )
            ->get();

        return response()->json($books);
    } 
 */
    public function getUserBookOfferInfo($user_id)
    {
        $book_info = DB::select("
            SELECT bo.img_url, bo.offer_id, u.name, p.publisher_name, w.title, g.genre_name, language, publication_year, quality, book_status, bo.created_at, bo.updated_at, 
                (SELECT GROUP_CONCAT(a.author_name SEPARATOR \", \") 
                FROM written_bies wb 
                LEFT JOIN authors a ON a.author_id = wb.author
                WHERE wb.work = w.work_id) AS authors
            FROM book_offers bo
                LEFT JOIN users u on u.id = bo.user
                LEFT JOIN publishers p on p.publisher_id = bo.publisher
                LEFT JOIN works w on w.work_id = bo.work
                LEFT JOIN genres g on g.genre_id = w.genre_id
            WHERE bo.user = $user_id
        ");

        return response()->json($book_info);
    }

    public function userUpdate(Request $request, $id)
    {        
        $validatedData = $request->validate([
            'publisher_name' => 'required|string|max:255',
            'genre_id' => 'required|integer|max:255|exists:genres,genre_id',
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'quality' => 'required|integer|max:255',
            'publication_year' => 'required|integer|min:1700|max:' . date('Y'),
            'img_url' => 'image|mimes:jpeg,png,jpg,gif|max:5000'
        ]);

        $bookOffer = BookOffer::where('offer_id', $id)->first();
        if (!$bookOffer) {
            return response()->json(['hiba' => 'Könyv nem található'], 404);
        }

        $publisher = Publisher::firstOrCreate([
            'publisher_name' => $validatedData['publisher_name']
        ]);
        $publisherId = $publisher->publisher_id;

        $work = Work::firstOrCreate(
            ['title' => $validatedData['title']],
            ['genre_id' => $validatedData['genre_id']]
        );
        $authors = array_map('trim', explode(',', $validatedData['authors']));
        $authorIds = [];
        foreach ($authors as $authorName) {
            if ($authorName === '') continue; // véd a ", "-től
            $author = Author::firstOrCreate(['author_name' => $authorName]);
            $authorIds[] = $author->author_id;
        }
        $work->authors()->sync($authorIds);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('books_pictures'), $filename);
            $bookOffer->img_url = 'books_pictures/' . $filename;
        }

        $bookOffer->update([
            'publisher' => $publisherId,
            'work' => $work->work_id,
            'language' => $validatedData['language'],
            'quality' => $validatedData['quality'],
            'publication_year' => $validatedData['publication_year'],
        ]);
        
        return response()->json(['message' => 'Sikeresen frissítve', 'data' => $bookOffer], 200);
    }

    public function newBookOffers()
    {
        $books = DB::table('book_offers')
        ->join('works', 'book_offers.work', '=', 'works.work_id')
        ->join('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id')
        ->join('written_bies', 'works.work_id', '=', 'written_bies.work')
        ->join('authors', 'written_bies.author', '=', 'authors.author_id')
        ->orderBy('book_offers.created_at', 'desc')
        ->take(3)
        ->select(
            'works.title',
            'publishers.publisher_name',
            'book_offers.book_status',
            'authors.author_name',
            'book_offers.publication_year',
            'book_offers.language',
            'book_offers.quality',
            'book_offers.user',
            'book_offers.created_at',
            'book_offers.updated_at',
            'book_offers.img_url'
        )
        ->get()
        ->map(function ($book) {
            // Ha van kép, akkor teljes URL-t adunk vissza
            $book->img_url = $book->img_url ? url($book->img_url) : url('/basic_book.png');
    
            // Ha a `created_at` null, akkor ne próbáljuk formázni
            $book->created_at = $book->created_at ? \Carbon\Carbon::parse($book->created_at)->format('Y-m-d H:i:s') : null;
            $book->updated_at = $book->updated_at ? \Carbon\Carbon::parse($book->updated_at)->format('Y-m-d H:i:s') : null;
    
            return $book;
        });

        return response()->json($books);
    }

    //get minden konyv ami csak eltezik mindennel egyutt exchangehez
    public function getThatBookOfferForExchange($id)
    {
        $books = DB::table('book_offers')
            ->leftJoin('works', 'book_offers.work', '=', 'works.work_id')
            ->leftJoin('publishers', 'book_offers.publisher', '=', 'publishers.publisher_id')
            ->leftJoin('written_bies', 'works.work_id', '=', 'written_bies.work')
            ->leftJoin('authors', 'written_bies.author', '=', 'authors.author_id')
            ->leftJoin('genres', 'works.genre_id', '=', 'genres.genre_id')
            ->leftJoin('users', 'book_offers.user', '=', 'users.id')
            ->where('book_offers.offer_id', '=', $id)
            ->select(
                'book_offers.img_url',
                'users.id',
                'book_offers.offer_id',
                'works.title',
                'publishers.publisher_name',
                'book_offers.book_status',
                DB::raw('GROUP_CONCAT(authors.author_name SEPARATOR ", ") as authors'),
                'book_offers.publication_year',
                'book_offers.language',
                'book_offers.quality',
                'book_offers.user',
                'genres.genre_name'
            )
            ->groupBy(
                'book_offers.img_url',
                'users.id',
                'book_offers.offer_id',
                'works.title',
                'publishers.publisher_name',
                'book_offers.book_status',
                'book_offers.publication_year',
                'book_offers.language',
                'book_offers.quality',
                'book_offers.user',
                'genres.genre_name'
            )
            ->first(); // Csak egyetlen könyvet lekérni, így az elsőt kérjük

        return response()->json($books);
    }

    public function softDelete($id) {
        $record = BookOffer::find($id);

        $record->book_status = 'x';
        $record->save();

        return response()->json(['message' => 'Sikeres törlés (soft delete).'], 200);
    }
}
