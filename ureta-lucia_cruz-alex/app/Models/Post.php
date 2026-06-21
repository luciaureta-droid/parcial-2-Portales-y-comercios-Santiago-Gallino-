<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //  CORRECCIÓN: Apuntamos a la tabla correcta de Libros que tiene esas columnas en inglés
    protected $table = 'books';

    // Habilitamos la asignación masiva para las columnas del formulario
   protected $fillable = ['title', 'price', 'publication_date', 'description', 'cover', 'author_fk'];

    // Relación con el Autor
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}