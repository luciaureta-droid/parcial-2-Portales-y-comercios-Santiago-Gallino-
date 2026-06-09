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
    protected $table = 'noticias'; // Usamos el nombre en español que definimos en la migración

    /**
     * @var string La clave primaria de la tabla.
     */
    protected $primaryKey = 'id';

    /**
     * Definimos qué campos se pueden cargar masivamente desde el array del Request.
     */
    protected $fillable = [
        'titulo', 
        'autor', 
        'precio', 
        'descripcion',
        'stock',         
    ];

    /**
     * Relación Muchos a Muchos con los Usuarios.
     * Un libro puede ser comprado/contratado por muchos usuarios.
     * Esto cumple con el requisito de "relaciones entre tablas" de la consigna.
     * * @return BelongsToMany
     */
    public function usuarios(): BelongsToMany {
        return $this->belongsToMany(User::class, 'usuario_tiene_producto', 'producto_id', 'usuario_id')
                    ->withTimestamps();
    }
}