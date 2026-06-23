<?php

namespace App\Http\Controllers;

use App\Mail\BookReserved; // Tu Mailable para libros
use App\Models\Book;       // Tu Modelo de libros
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookReservationController extends Controller
{
    public function reserve(int $id)
    {
        // 1. Buscamos el libro por su ID
        $book = Book::findOrFail($id);

        // 2. Enviamos el email usando Mailtrap al usuario logueado, pasando el libro
        Mail::to(Auth::user()->email)->send(new BookReserved($book));

        // 3. Redireccionamos al catálogo con el mensaje de éxito
        return redirect()->route('books.index')
            ->with('status', 'La reserva del libro <b>' . $book->title . '</b> se procesó con éxito. ¡Revisá tu correo!');
    }
}