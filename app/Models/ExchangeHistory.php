<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExchangeHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ExchangeHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'interested_user',
        'desired_idem',
        'offered_item',
        'exchange_status'
    ];
}
