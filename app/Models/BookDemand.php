<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BookDemand extends Model
{
    /** @use HasFactory<\Database\Factories\BookDemandFactory> */
    use HasFactory;

    protected $primaryKey = 'demand_id';

    protected $fillable = [
        'user',
        'publisher',
        'work',
        'language',
        'min_publication_year',
        'max_publication_year',
        'demand_status',
    ];
}
