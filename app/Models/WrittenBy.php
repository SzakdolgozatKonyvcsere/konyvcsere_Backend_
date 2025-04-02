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
        'work',
        'author'
    ];

    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
