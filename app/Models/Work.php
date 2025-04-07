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

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
    public function writtenBy()
    {
        return $this->belongsTo(WrittenBy::class, 'work');
    }
    public function authors()
    {   //több a többhöz kapcsolat leírására
        return $this->belongsToMany(Author::class, 'written_bies', 'work', 'author');
    }
}
