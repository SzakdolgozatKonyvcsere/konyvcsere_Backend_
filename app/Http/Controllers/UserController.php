<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function index() {
        return User::all();
    } // All users

    function show($id){
        return User::find($id);
    }

    function update(Request $request, $id) {
        $validatedData = $request->validate([
            "name" => "string|max:255|unique:users,name,$id",
            "full_name" => "string|max:255|",
            "email" => "string|max:255|unique:users,email,$id",
            "city" => "string|max:255|",
            "tel" => "string|max:255|unique:users,tel,$id"
        ]);

        $user = User::find($id);

        $user->update($validatedData);
    }
    
    public function getGivenUserProfileExchangeInfo($id){
         // Beállítjuk a Carbon nyelvét magyarra
        Carbon::setLocale('hu');

        // Először lekérjük a felhasználót
        $user = DB::table('users')
            ->where('users.id', '=', $id)
            ->select('users.*') // Csak a user adatait kérjük le
            ->first(); // Csak egyetlen felhasználót lekérni, így az elsőt kérjük


        // Ha nincs ilyen user, 404-es hiba
        if (!$user) {
            return response()->json(['error' => 'Felhasználó nem található!'], 404);
        }

        // Külön lekérdezzük az exchange_count-ot
        $exchange_count = DB::table('exchange_histories')
            ->where('interested_user', '=', $id)
            ->where('exchange_status', '=', 'a')
            ->count();

        // Regisztráció ideje emberi formátumban
         // A created_at mezőt Carbon objektummá alakítjuk és kiszámoljuk az eltelt időt
            // -> CARBON a created_at mező formázására
            // -> diffForH kiszámítja az emberi olvasható formátumot
        $user->registered_since = Carbon::parse($user->created_at)->diffForHumans();
        unset($user->created_at); // Az eredeti created_at mezőt eltávolítjuk

        // Hozzáadjuk az exchange_count értéket
        $user->exchange_count = $exchange_count;

        return response()->json($user);
            
    }
    public function getGivenUserMostExchangedGenre($userId)
    {
        $mufaj = DB::table('exchange_histories as c')
            ->select('g.genre_name', DB::raw('count(c.exchange_id) as exchange_number'))
            ->join('book_offers as bk', 'c.desired_item', '=', 'bk.offer_id')
            ->join('works as w', 'bk.work', '=', 'w.work_id')
            ->join('genres as g', 'w.genre_id', '=', 'g.genre_id')
            ->where('c.exchange_status', 'a') 
            ->where('c.interested_user', $userId) 
            ->groupBy('g.genre_name')
            ->orderByDesc(DB::raw('count(c.exchange_id)'))
            ->limit(1) 
            ->get();

        return response()->json($mufaj);
    }
    
    public function authorAllWorks($author)
    {

        $works = DB::table('authors')
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->where('author_name', '=', $author)
            ->select('works.title')
            ->get();

        return $works;

    }

    public function mostOfferedAuthors()
    {
        $authors = Author::select('author_name', DB::raw('count(book_offers.offer_id) as thismany_books'))
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->join('book_offers', 'works.work_id', '=', 'book_offers.work')
            ->groupBy('authors.author_name')
            ->orderByDesc(DB::raw('count(book_offers.offer_id)'))
            ->limit(1) //limitálva 1re
            ->get();

        return $authors;
    }

    public function mostDemandedAuthors()
    {
        $authors = DB::table('authors')
            ->select('authors.author_name', DB::raw('count(book_demands.demand_id) as thismany_books'))
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->join('book_demands', 'works.work_id', '=', 'book_demands.work')
            ->groupBy('authors.author_name')
            ->orderByDesc(DB::raw('count(book_demands.demand_id)'))
            ->limit(1)  
            ->get();

        return response()->json($authors);
    }


    public function inactiveUsers()
    {
        
        $inactiveUsers = User::where('online_status', 0)
            ->select('name', 'email', 'full_name', 'city')
            ->get();

        return response()->json($inactiveUsers);
    }


    public function givenUsersExchanges($user_id)
    {
        $exchanges = DB::table('exchange_histories')
            ->where('interested_user', $user_id)
            ->orWhereIn('desired_item', function ($query) use ($user_id) {
                $query->select('offer_id')
                      ->from('book_offers')
                      ->where('user', $user_id);
            })
            ->orWhereIn('offered_item', function ($query) use ($user_id) {
                $query->select('offer_id')
                      ->from('book_offers')
                      ->where('user', $user_id);
            })
            ->get();

        return response()->json($exchanges);
    } 

    /* public function givenUsersExchanges($user_id)
    {
        $exchanges = DB::table('exchange_histories')
            ->leftJoin('users as interested_user', 'exchange_histories.interested_user', '=', 'interested_user.id')
            ->leftJoin('book_offers as desired_book', 'exchange_histories.desired_item', '=', 'desired_book.offer_id')
            ->leftJoin('users as desired_book_owner', 'desired_book.user', '=', 'desired_book_owner.id')
            ->leftJoin('book_offers as offered_book', 'exchange_histories.offered_item', '=', 'offered_book.offer_id')
            ->leftJoin('users as offered_book_owner', 'offered_book.user', '=', 'offered_book_owner.id')
            
            ->where('exchange_histories.interested_user', $user_id)
            ->orWhereIn('desired_item', function ($query) use ($user_id) {
                $query->select('offer_id')
                      ->from('book_offers')
                      ->where('user', $user_id);
            })
            ->orWhereIn('exchange_histories.offered_item', function ($query) use ($user_id) {
                $query->select('offer_id')
                      ->from('book_offers')
                      ->where('user', $user_id);
            })

            ->select(
                'exchange_histories.*',
                'interested_user.name as interested_user_name',
                'interested_user.email as interested_user_email',
                'desired_book.*',
                'desired_book_owner.name as desired_book_owner_name',
                'desired_book_owner.email as desired_book_owner_email',
                'offered_book.*',
                'offered_book_owner.name as offered_book_owner_name',
                'offered_book_owner.email as offered_book_owner_email'
            )

            ->get();

        return response()->json($exchanges);
        //jo lehet nem kell bele a userrel osszekotni mert azt egy masik lekerdezessel 
        //kotom ossze ugyanugy mint a modalnal
    } */

    public function getUserProfileInfo($user_id){
        $user_info = DB::select("
            SELECT name, email, full_name, city, tel, role, online_status, img_url
            FROM users u
            WHERE u.id = $user_id
        ");

        return response()->json($user_info);
    }

    

    public function updateBookPicture(Request $request, $offer_id){
        $request->validate([
            'img_url' => ['nullable', 'mimes:jpg,png,gif,jpeg,svg', 'max:2048']
        ]);
    
        $book = BookOffer::find($offer_id);
        if(!$book){
            return response()->json(['error' => 'Book not found!'], 404);
        }
    
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $imageName = time() . '.' . $file->getClientOriginalExtension(); 
            $file->move(public_path('uploads/books'), $imageName);
            $imagePath = 'uploads/books/' . $imageName;  
    
            $book->img_url = $imagePath;
            $book->save();
            
            return response()->json(['message' => 'Book image updated!', 'img_url' => asset($book->img_url)]);
        }
    
        return response()->json(['error' => 'No image uploaded!'], 400);
    }


    public function updateProfilePicture(Request $request) {
        $request->validate([
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
    
        $user = Auth::user();
    
        //Ha volt régi kép, töröljük
        if ($user->img_url && !str_contains($user->img_url, 'profile_pictures/user_basic_pfp.jpg')) {
            // Ezt a default értéket pls ignore, majd beköltözik egyszer a public-ba 
            $oldImagePath = public_path($user->img_url);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        
        //Feltöltött kép kezelése
        if ($request->hasFile('img_url')) {
            $file = $request->file('img_url');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile_pictures'), $imageName);
            $imagePath = 'profile_pictures/' . $imageName;
    
            DB::table('users')->where('id', $user->id)->update(['img_url' => $imagePath]);
            
            return response()->json(['message' => 'Profile picture updated!', 'img_url' => $imagePath]);
        }
    
        return response()->json(['message' => 'No image uploaded'], 400);
    }

}