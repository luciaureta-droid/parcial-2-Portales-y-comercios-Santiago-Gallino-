<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'price',
        'publication_date',
        'description',
        'cover',
        'cover_description',
        'author_fk',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_fk');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,
            'book_genre',
            'book_fk',
            'genre_fk'
        );
    }
}