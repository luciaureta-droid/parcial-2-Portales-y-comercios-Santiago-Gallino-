<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Clase Book
 * Representa la entidad de un Libro (Producto) en el sistema.
 * * @package App\Models
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
        'author_fk',//Se cambio esto, antes era author
        'description',
        'cover',
        'cover_description'
    ];


    /* Se agrega esta funcion. Esto esta en la version 3 de git*/
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_fk');
    }

    /* Se agrega esta funcion. Esto esta en la version 3 de git  */
    public function genres()
    {
        return $this->belongsToMany(
            Genre::class,
            'book_genre',
            'book_fk',
            'genre_fk'
        );
    }
}
