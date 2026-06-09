<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Clase User
 * Representa la entidad de un Usuario en el sistema (Común o Administrador).
 * * @package App\Models
 */
class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Los atributos que se pueden asignar de forma masiva (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role', // 'comun' o 'admin' según la consigna
    ];

    /**
     * Los atributos que deben permanecer ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relación Muchos a Muchos con los Productos/Libros contratados.
     * Permite ver qué libros o servicios compró este usuario.
     * * @return BelongsToMany
     */
    public function productos(): BelongsToMany {
        return $this->belongsToMany(Book::class, 'usuario_tiene_producto', 'usuario_id', 'producto_id')
                    ->withTimestamps();
    }
}