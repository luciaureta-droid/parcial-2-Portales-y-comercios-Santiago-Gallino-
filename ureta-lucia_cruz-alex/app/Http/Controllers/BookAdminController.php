<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book; // 🌟 Conectamos con el modelo real de libros 
use Illuminate\Http\Request;

class BookAdminController extends Controller
{
    /**
     * Muestra la tabla del CRUD (El ABM de Libros)
     */
    public function index()
    {
        // Traemos tus libros ordenados por fecha de creación, paginados de a 5 para la tabla
        $books = Book::orderBy('created_at', 'desc')->paginate(5);

        // Retornamos la vista books.admin pasándole la colección de libros
        return view('books.admin', compact('books'));
    }

    /**
     * Muestra el formulario para editar un libro existente
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        
        // Retornará la vista para editar
        return view('books.edit', compact('book'));
    }

    /**
     * Elimina un libro de la base de datos
     */
    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        // Redirecciona de vuelta con un mensaje flash de éxito para el layout
        return redirect()->route('books.admin')->with([
            'feedback.message' => "El libro <strong>{$book->title}</strong> fue eliminado correctamente.",
            'feedback.type' => 'danger'
        ]);
    }
}