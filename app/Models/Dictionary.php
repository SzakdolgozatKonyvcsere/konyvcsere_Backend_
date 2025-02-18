<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dictionary extends Model
{
    /** @use HasFactory<\Database\Factories\DictionaryFactory> */
    use HasFactory;

    protected $fillable = [
        'type', // pl: minoseg | csere allapot
        'value' // pl: hasznalt | elcserelve
    ];
}
