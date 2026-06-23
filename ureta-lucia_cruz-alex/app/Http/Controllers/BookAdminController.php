<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookAdminController extends Controller
{
    public function index()
    {
        $books = Book::paginate(5);

        return view('books.admin', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        $authors = Author::all();

        return view('books.create', [
            'authors' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        // 1. Modificamos la validación tradicional. author_fk ahora es nullable.
        $request->validate([
            'title'            => 'required|min:2',
            'price'            => 'required|numeric',
            'publication_date' => 'required|date',
            'author_fk'        => 'nullable|integer', 
            'new_author_name'  => 'nullable|string|max:100',
        ], [
            'title.required'            => 'El título debe tener un valor.',
            'title.min'                 => 'El título debe tener al menos :min caracteres.',
            'price.required'            => 'El precio debe tener un valor.',
            'price.numeric'             => 'El precio debe ser un valor numérico.',
            'publication_date.required' => 'La fecha de publicación es obligatoria.',
            'publication_date.date'     => 'Debe ingresar una fecha válida.',
            'new_author_name.string'    => 'El nombre del nuevo autor debe ser un texto válido.',
            'new_author_name.max'       => 'El nombre del autor no puede superar los 100 caracteres.',
        ]);

        // 2. Control nativo con PHP: Verificamos que no se hayan dejado ambos campos vacíos
        if (!$request->filled('author_fk') && !$request->filled('new_author_name')) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'author_fk' => 'Debe seleccionar un autor existente o completar el campo para crear un nuevo autor.'
                ]);
        }

        // 3. Capturamos los datos básicos para el libro
        $data = $request->only(['title', 'price', 'description', 'publication_date', 'author_fk']);

        // 4. Si se escribió un autor nuevo, se crea primero usando PHP y Eloquent tradicional
        if ($request->filled('new_author_name')) {
            $nuevoAutor = Author::create([
                'name'        => $request->input('new_author_name'),
                'nationality' => 'Desconocida',
                'birth_date'  => '1970-01-01',
                'biography'   => 'Sin biografía disponible.' // 🌟 Agregado para cumplir con tu base de datos
            ]);
            
            // Reemplazamos la clave foránea con el ID recién autogenerado por MySQL
            $data['author_fk'] = $nuevoAutor->id;
        }

        // 5. Se crea el libro con los datos finales consolidados
        $book = Book::create($data);

        return redirect()
            ->route('books.admin')
            ->with('feedback.message', 'El libro <b>' . e($book->title) . '</b> se creó con éxito.')
            ->with('feedback.type', 'success');
    }

    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();

        return view('books.edit', [
            'book' => $book,
            'authors' => $authors,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|min:2',
            'price' => 'required|numeric',
            'publication_date' => 'nullable|date',
            'author_fk' => 'nullable|integer', 
        ], [
            'title.required' => 'El título debe tener un valor.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'price.required' => 'El precio debe tener un valor.',
            'price.numeric' => 'El precio debe ser un valor numérico.',
            'publication_date.date' => 'Debe ingresar una fecha válida.',
        ]);

        $data = [
            'title'            => $request->input('title'),
            'price'            => $request->input('price'),
            'description'      => $request->input('description'),
            'publication_date' => $request->input('publication_date') ?? $book->publication_date,
            'author_fk'        => $request->input('author_fk') ?? $book->author_fk,
        ];
        
        $book->update($data);

        return redirect()
            ->route('books.admin')
            ->with('feedback.message', 'El libro <b>' . e($book->title) . '</b> se editó con éxito.')
            ->with('feedback.type', 'success');
    }

    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);

        // Uso formal de Eloquent para limpiar la relación muchos a muchos en book_genre
        $book->genres()->detach();

        // Elimina el registro padre de forma limpia
        $book->delete();

        return redirect()
            ->route('books.admin')
            ->with('feedback.message', 'El libro <b>' . e($book->title) . '</b> se eliminó con éxito.')
            ->with('feedback.type', 'success');
    }
}