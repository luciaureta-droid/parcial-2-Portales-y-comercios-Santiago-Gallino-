<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100,
        );
    }

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
        )->withTimestamps();
    }
}
