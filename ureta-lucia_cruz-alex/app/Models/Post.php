<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Le avisamos a Laravel qué campos permitimos guardar desde el formulario
    protected $fillable = ['title', 'summary', 'content', 'author', 'image'];
}