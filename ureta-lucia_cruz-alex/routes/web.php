<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController; //Se agrego esto por el author controller
/*
|--------------------------------------------------------------------------
|  SITIO PÚBLICO (Para usuarios comunes)
|--------------------------------------------------------------------------
*/

// Carga directa de la vista welcome para evitar la pantalla por defecto de Laravel
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/nosotros', [HomeController::class, 'about'])
    ->name('about');

// Catálogo público de Libros (Cards)
Route::get('/libros/listado', [BookController::class, 'index'])
    ->name('books.index');

Route::get('/libros/{id}', [BookController::class, 'show'])
    ->name('books.show')
    ->whereNumber('id');

// Blog de Noticias público (Listado y Detalle)
//Route::get('/blog/listado', [PostController::class, 'index'])//Se cambio esta linea, esto puso Lucia, 
Route::get('/blog/listado', [AuthorController::class, 'index']) //Esta nueva linea es para redireccionar al blog
    ->name('blog.index'); //Esta linea es la misma para cualquiera de los dos.


Route::get('/blog/{id}', [PostController::class, 'show'])
    ->name('blog.show')
    ->whereNumber('id');


/*
|--------------------------------------------------------------------------
|  AUTENTICACIÓN (Hecha a mano, como exige la consigna)
|--------------------------------------------------------------------------
*/

Route::get('/ingresar', [AuthController::class, 'show'])
    ->name('login.show');

// Aquí corregimos el .process por .execute para que coincida con tu Blade
Route::post('/ingresar', [AuthController::class, 'process'])
    ->name('login.execute');

Route::post('/cerrar-sesion', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
|  PANEL DE ADMINISTRACIÓN / CRUD DE NOTICIAS (Sin Middleware por ahora)
|--------------------------------------------------------------------------
| Dejamos estas rutas limpias para que puedas testearlas directamente en el navegador.
*/

Route::get('/admin/blog/crear', [PostController::class, 'create'])
    ->name('blog.create');

Route::post('/admin/blog/guardar', [PostController::class, 'store'])
    ->name('blog.store');

Route::get('/admin/blog/{id}/editar', [PostController::class, 'edit'])
    ->name('blog.edit')
    ->whereNumber('id');

Route::put('/admin/blog/{id}/actualizar', [PostController::class, 'update'])
    ->name('blog.update')
    ->whereNumber('id');

Route::get('/admin/blog/{id}/eliminar', [PostController::class, 'delete'])
    ->name('blog.delete')
    ->whereNumber('id');

Route::delete('/admin/blog/{id}/borrar', [PostController::class, 'destroy'])
    ->name('blog.destroy')
    ->whereNumber('id');

// Listado de usuarios para el Administrador
Route::get('/admin/usuarios', [AuthController::class, 'listUsers'])
    ->name('admin.users.index');

// Rutas para la sección de Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::post('/contacto', function () {
    return back()->with('feedback.message', '¡Gracias por comunicarte! Te responderemos a la brevedad.')->with('feedback.type', 'success');
});

// Ruta para el ABM / Panel de Administración de Libros

Route::get('/admin/libros/crear', [\App\Http\Controllers\BookAdminController::class, 'create'])
    ->name('books.create')
    ->middleware('auth');


Route::post('/admin/libros/guardar', [\App\Http\Controllers\BookAdminController::class, 'store'])
    ->name('books.store')
    ->middleware('auth');


Route::get('/admin/libros', [App\Http\Controllers\BookAdminController::class, 'index'])
    ->name('books.admin')
    ->middleware('auth'); // Para que solo entren administradores logueados


Route::put('/admin/libros/{id}/actualizar', [\App\Http\Controllers\BookAdminController::class, 'update'])
    ->name('books.update')
    ->whereNumber('id')
    ->middleware('auth');


// Rutas para Editar y Eliminar Libros
Route::get('/admin/libros/{id}/editar', [\App\Http\Controllers\BookAdminController::class, 'edit'])
    ->name('books.edit')
    ->middleware('auth');





Route::delete('/admin/libros/{id}', [\App\Http\Controllers\BookAdminController::class, 'destroy'])
    ->name('books.destroy')
    ->middleware('auth');
