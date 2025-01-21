<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrittenBy extends Model
{
    /** @use HasFactory<\Database\Factories\WrittenByFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = null;
    protected $fillable = [
        'mu',
        'szerzo'
    ];
}
