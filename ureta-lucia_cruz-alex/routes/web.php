<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Vistas Públicas (Acceso para cualquier usuario)
|--------------------------------------------------------------------------
*/

// Ruta raíz: Redirecciona al catálogo de libros
/* Route::get('/', function () {
    return redirect()->route('books.index');
})->name('home'); */

//Direccionamiento de home, nosotros y contacto, queda funcionando.
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/nosotros', [HomeController::class, 'about'])->name('about');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

// Catálogo de Libros público
Route::get('/libros', [BookController::class, 'index'])->name('books.index');
Route::get('/libros/{id}', [BookController::class, 'show'])->name('books.show')->whereNumber('id');

// Listado y detalle del Blog público
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [PostController::class, 'show'])->name('blog.show')->whereNumber('id');

// Secciones institucionales complementarias
/* Esto lo comente  */
/* Route::get('/nosotros', function () {
    return "Pagina Sobre Nosotros (En construccion)";
})->name('about'); */

Route::get('/nosotros-es', function () {
    return redirect()->route('about');
})->name('nosotros');



/* Route::get('/nosotros-es', function () {
    return redirect()->route('about');
})->name('nosotros'); */

/* Route::get('/contacto', function () {
    //return "Pagina de Contacto (En construccion)";
    return redirect()->route('contacto');
})->name('contacto'); */


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'show'])->name('login.show');
Route::post('/login', [AuthController::class, 'process'])->name('login.execute');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Rutas del Sistema de Reservas (Protegido por login al estilo del Profesor)
|--------------------------------------------------------------------------
*/

// Ruta para procesar la reserva del libro (Requiere sesión activa, sea Admin o Cliente)
Route::post('/libros/{id}/reservar', [BookReservationController::class, 'reserve'])
    ->name('books.reserve')
    ->middleware('auth')
    ->whereNumber('id');


/*
|--------------------------------------------------------------------------
| Panel de Administración (Protegido explícitamente por el Middleware 'admin')
|--------------------------------------------------------------------------
*/

// --- CRUD de Libros (Panel Admin) ---
Route::get('/admin/libros', [BookAdminController::class, 'index'])->name('books.admin')->middleware('admin');
Route::get('/admin/libros/nuevo', [BookAdminController::class, 'create'])->name('books.create')->middleware('admin');
Route::post('/admin/libros/nuevo', [BookAdminController::class, 'store'])->name('books.store')->middleware('admin');

Route::get('/admin/libros/{id}/editar', [BookAdminController::class, 'edit'])
    ->name('books.edit')
    ->middleware('admin')
    ->whereNumber('id');

Route::put('/admin/libros/{id}/editar', [BookAdminController::class, 'update'])
    ->name('books.update')
    ->middleware('admin')
    ->whereNumber('id');

Route::get('/admin/libros/{id}/eliminar', [BookAdminController::class, 'delete'])->name('books.delete')->middleware('admin')->whereNumber('id');
Route::delete('/admin/libros/{id}/eliminar', [BookAdminController::class, 'destroy'])->name('books.destroy')->middleware('admin')->whereNumber('id');


// --- CRUD de Blog / Noticias (Panel Admin) ---
Route::get('/blog/nuevo', [PostController::class, 'create'])->name('blog.create')->middleware('admin');
Route::post('/blog/nuevo', [PostController::class, 'store'])->name('blog.store')->middleware('admin');

Route::get('/blog/{id}/editar', [PostController::class, 'edit'])->name('blog.edit')->middleware('admin')->whereNumber('id');
Route::put('/blog/{id}/editar', [PostController::class, 'update'])->name('blog.update')->middleware('admin')->whereNumber('id');

Route::get('/blog/{id}/eliminar', [PostController::class, 'delete'])->name('blog.delete')->middleware('admin')->whereNumber('id');
Route::delete('/blog/{id}/eliminar', [PostController::class, 'destroy'])->name('blog.destroy')->middleware('admin')->whereNumber('id');