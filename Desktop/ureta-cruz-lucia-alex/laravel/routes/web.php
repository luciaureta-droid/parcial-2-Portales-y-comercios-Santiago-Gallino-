<?php

use Illuminate\Support\Facades\Route;

// Ruta Home
Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

// Ruta Nosotros
Route::get('/nosotros', [\App\Http\Controllers\HomeController::class, 'about']);

// Ruta Libros (Cambiamos "peliculas" por "book" y "MoviesController" por "BookController")
Route::get('/book/listado', [\App\Http\Controllers\BookController::class, 'index']);