<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //Todo esto lo agregue yo
    use HasFactory;

    //  CORRECCIÓN: Apuntamos a la tabla correcta de Libros que tiene esas columnas en inglés
    //protected $table = 'books';//Antes estaba asi, esto debe devolver los autores
    protected $table = 'authors';

    // Habilitamos la asignación masiva para las columnas del formulario
    protected $fillable = [
        'name',
        'nationality',
        'birth_date',
        'biography',
        'photo',
        'photo_description'
    ];

    // Relación con libro
    public function books()
    {
        return $this->hasMany(Book::class, 'author_fk');
    }
}
