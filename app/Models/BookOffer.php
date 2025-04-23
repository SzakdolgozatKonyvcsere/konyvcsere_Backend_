<?php

namespace App\Models;

use App\Observers\BookOfferObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

#[ObservedBy([BookOfferObserver::class])]
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
        return $this->belongsTo(Work::class, 'work_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function publisherModel()
    {
        return $this->belongsTo(Publisher::class, 'publisher', 'publisher_id');
    }
    public function workModel()
    {
        return $this->belongsTo(Work::class, 'work', 'work_id');
    }
}
