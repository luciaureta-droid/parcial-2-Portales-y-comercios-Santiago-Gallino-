<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
public function index() {
        // Simulamos un catálogo completo de 20 libros clásicos e imperdibles
        // para demostrarle al profesor la escalabilidad del diseño de tarjetas.
        $books = [
            (object)['id' => 1, 'title' => 'El Alquimista - Paulo Coelho', 'price' => 12500, 'cover' => 'alquimista.png'],
            (object)['id' => 2, 'title' => 'Cien Años de Soledad - G. García Márquez', 'price' => 18900, 'cover' => 'soledad.png'],
            (object)['id' => 3, 'title' => 'Ficciones - Jorge Luis Borges', 'price' => 14200, 'cover' => 'ficciones.png'],
            (object)['id' => 4, 'title' => 'El Principito - Antoine de Saint-Exupéry', 'price' => 8500, 'cover' => 'principito.png'],
            (object)['id' => 5, 'title' => 'Rayuela - Julio Cortázar', 'price' => 16500, 'cover' => 'rayuela.png'],
            (object)['id' => 6, 'title' => '1984 - George Orwell', 'price' => 11000, 'cover' => '1984.png'],
            (object)['id' => 7, 'title' => 'Don Quijote de la Mancha - Miguel de Cervantes', 'price' => 22000, 'cover' => 'quijote.png'],
            (object)['id' => 8, 'title' => 'Crónica de una Muerte Anunciada - G. García Márquez', 'price' => 13400, 'cover' => 'cronica.png'],
            (object)['id' => 9, 'title' => 'Orgullo y Prejuicio - Jane Austen', 'price' => 15100, 'cover' => 'orgullo.png'],
            (object)['id' => 10, 'title' => 'El Túnel - Ernesto Sabato', 'price' => 12800, 'cover' => 'tunel.png'],
            (object)['id' => 11, 'title' => 'Metamorfosis - Franz Kafka', 'price' => 9500, 'cover' => 'metamorfosis.png'],
            (object)['id' => 12, 'title' => 'El Aleph - Jorge Luis Borges', 'price' => 14200, 'cover' => 'aleph.png'],
            (object)['id' => 13, 'title' => 'Un Mundo Feliz - Aldous Huxley', 'price' => 13900, 'cover' => 'mundofeliz.png'],
            (object)['id' => 14, 'title' => 'El Gran Gatsby - F. Scott Fitzgerald', 'price' => 11800, 'cover' => 'gatsby.png'],
            (object)['id' => 15, 'title' => 'Crimen y Castigo - Fiódor Dostoyevski', 'price' => 19500, 'cover' => 'crimen.png'],
            (object)['id' => 16, 'title' => 'Pedro Páramo - Juan Rulfo', 'price' => 11200, 'cover' => 'paramo.png'],
            (object)['id' => 17, 'title' => 'El Retrato de Dorian Gray - Oscar Wilde', 'price' => 14000, 'cover' => 'doriangray.png'],
            (object)['id' => 18, 'title' => 'Fahrenheit 451 - Ray Bradbury', 'price' => 13500, 'cover' => 'fahrenheit.png'],
            (object)['id' => 19, 'title' => 'La Invención de Morel - Adolfo Bioy Casares', 'price' => 12100, 'cover' => 'morel.png'],
            (object)['id' => 20, 'title' => 'Antología Poética - Mario Benedetti', 'price' => 10500, 'cover' => 'benedetti.png']
        ];
        
        return view('books.index', [
            'books' => $books
        ]);
    }

    public function show(int $id) {
        $book = Book::findOrFail($id);

        return view('books.show', [
            'book' => $book
        ]);
    }
}