<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title', 
        'price', 
        'publication_date', 
        'description', 
        'cover', 
        'author_fk'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_fk');
    }
}