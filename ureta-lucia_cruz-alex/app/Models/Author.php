<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    // Agregamos 'biography' al array para que Laravel permita su guardado masivo
    protected $fillable = ['name', 'nationality', 'birth_date', 'biography'];

    /**
     * Relacion tradicional de uno a muchos: Un autor tiene muchos libros
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'author_fk', 'id');
    }
}