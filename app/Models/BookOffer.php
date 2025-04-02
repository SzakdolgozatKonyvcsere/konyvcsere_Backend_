<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BookOffer extends Model
{
    /** @use HasFactory<\Database\Factories\BookOfferFactory> */
    use HasFactory;

    protected $primaryKey = "offer_id";
    
    protected $fillable = [
        'user',
        'publisher',
        'work',
        'language',
        'publication_year',
        'quality',
        'book_status',
        'img_url',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class, 'work');
    }
}
