<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Publisher extends Model
{
    /** @use HasFactory<\Database\Factories\PublisherFactory> */
    use HasFactory;

    protected $primaryKey = 'publisher_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = ['publisher_name'];

}
