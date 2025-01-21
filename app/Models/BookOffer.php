<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOffer extends Model
{
    /** @use HasFactory<\Database\Factories\BookOfferFactory> */
    use HasFactory;

    protected $fillable = [
        'user',
        'publisher',
        'work',
        'language',
        'publication_year',
        'quality',
        'book_status',
        //'kep_url',
    ];
}
