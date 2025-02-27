<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index() {
        return User::all();
    } // All users

    function show($id){
        return User::find($id);
    } 


    
    public function getSzerzoOsszesMuve($author)
    {

        $works = DB::table('authors')
            ->join('written_bies', 'authors.author_id', '=', 'written_bies.author')
            ->join('works', 'written_bies.work', '=', 'works.work_id')
            ->where('author_name', '=', $author)
            ->select('works.title')
            ->get();

        return $works;

    }

    
}
