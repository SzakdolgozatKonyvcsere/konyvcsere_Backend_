<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;

    protected $primaryKey = 'work_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'genre_id',
        'title'
    ];
}
