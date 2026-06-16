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
        'author',
        'description',
        'cover',
        'cover_description'
    ];
}