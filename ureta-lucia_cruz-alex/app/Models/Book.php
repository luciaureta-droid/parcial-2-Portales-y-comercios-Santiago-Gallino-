<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Clase Book
 * Representa la entidad de un Libro (Producto) en el sistema.
 * @package App\Models
 */
class Book extends Model
{
    use HasFactory;

    /**
     * @var string La tabla asociada al modelo.
     */
    protected $table = 'books';

    /**
     * @var string La clave primaria de la tabla.
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'price',
        'publication_date',
        'author',
        'description',
        'cover',
        'cover_description',
        'author_fk', 
    ];

    /**
     * Relación de muchos a muchos con los Géneros.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,      // Modelo con el que se relaciona
            'book_genre',      // Tabla intermedia en tu phpMyAdmin
            'book_fk',         // Clave foránea de esta tabla en la intermedia
            'genre_fk'         // Clave foránea del género en la intermedia
        );
    }
}