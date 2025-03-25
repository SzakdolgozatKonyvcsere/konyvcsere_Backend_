<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BookOffer;
use App\Models\User;
use Illuminate\Http\Request;
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
        if ($user->img_url && !str_contains($user->img_url, 'https://i.pinimg.com/1200x/2c/47/d5/2c47d5dd5b532f83bb55c4cd6f5bd1ef.jpg')) {
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