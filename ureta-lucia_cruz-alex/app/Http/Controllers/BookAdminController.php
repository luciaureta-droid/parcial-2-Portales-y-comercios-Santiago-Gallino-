<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookAdminController extends Controller
{
    /**
     * Muestra la tabla del CRUD (El ABM de Libros)
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(5);

        return view('books.admin', compact('books'));
    }

    /**
     * Muestra el formulario para editar un libro existente
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Actualiza un libro existente
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => ['required', 'min:2'],
            'price' => ['required', 'numeric', 'min:0'],
            'publication_date' => ['required', 'date'],
            'description' => ['required'],
            'cover' => ['nullable', 'image'],
            'cover_description' => ['nullable'],
        ]);

        $book = Book::findOrFail($id);

        $data = $request->only([
            'title',
            'price',
            'publication_date',
            'description',
            'cover_description'
        ]);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('books.admin')->with([
            'feedback.message' => "El libro <strong>{$book->title}</strong> fue actualizado correctamente.",
            'feedback.type' => 'success'
        ]);
    }

    /**
     * Elimina un libro de la base de datos
     */
    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.admin')->with([
            'feedback.message' => "El libro <strong>{$book->title}</strong> fue eliminado correctamente.",
            'feedback.type' => 'danger'
        ]);
    }
}