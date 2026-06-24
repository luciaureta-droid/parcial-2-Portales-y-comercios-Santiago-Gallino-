<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $genres = Genre::all();

        return view('books.create', [
            'authors' => $authors,
            'genres' => $genres,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|min:2',
            'price'            => 'required|numeric',
            'publication_date' => 'required|date',
            'author_fk'        => 'nullable|integer',
            'new_author_name'  => 'nullable|string|max:100',
            'description'      => 'nullable|string',
            'cover'            => 'nullable|image',
            'genres'           => 'nullable|array',
            'genres.*'         => 'integer|exists:genres,id',
        ], [
            'title.required'            => 'El título debe tener un valor.',
            'title.min'                 => 'El título debe tener al menos :min caracteres.',
            'price.required'            => 'El precio debe tener un valor.',
            'price.numeric'             => 'El precio debe ser un valor numérico.',
            'publication_date.required' => 'La fecha de publicación es obligatoria.',
            'publication_date.date'     => 'Debe ingresar una fecha válida.',
            'new_author_name.string'    => 'El nombre del nuevo autor debe ser un texto válido.',
            'new_author_name.max'       => 'El nombre del autor no puede superar los 100 caracteres.',
            'cover.image'               => 'La portada debe ser una imagen válida.',
        ]);

        if (!$request->filled('author_fk') && !$request->filled('new_author_name')) {
            return redirect()->back()
                ->withInput()
                ->withErrors([
                    'author_fk' => 'Debe seleccionar un autor existente o completar el campo para crear un nuevo autor.'
                ]);
        }

        $data = $request->only([
            'title',
            'price',
            'description',
            'publication_date',
            'author_fk'
        ]);

        if ($request->filled('new_author_name')) {
            $nuevoAutor = Author::create([
                'name'        => $request->input('new_author_name'),
                'nationality' => 'Desconocida',
                'birth_date'  => '1970-01-01',
                'biography'   => 'Sin biografía disponible.'
            ]);

            $data['author_fk'] = $nuevoAutor->id;
        }

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('books', 'public');
        }

        $book = Book::create($data);

        $book->genres()->sync($request->input('genres', []));

        return redirect()
            ->route('books.admin')
            ->with('feedback.message', 'El libro <b>' . e($book->title) . '</b> se creó con éxito.')
            ->with('feedback.type', 'success');
    }

    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $genres = Genre::all();

        return view('books.edit', [
            'book' => $book,
            'authors' => $authors,
            'genres' => $genres,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title'            => 'required|min:2',
            'price'            => 'required|numeric',
            'publication_date' => 'nullable|date',
            'author_fk'        => 'nullable|integer',
            'description'      => 'nullable|string',
            'cover'            => 'nullable|image',
            'genres'           => 'nullable|array',
            'genres.*'         => 'integer|exists:genres,id',
        ], [
            'title.required'        => 'El título debe tener un valor.',
            'title.min'             => 'El título debe tener al menos :min caracteres.',
            'price.required'        => 'El precio debe tener un valor.',
            'price.numeric'         => 'El precio debe ser un valor numérico.',
            'publication_date.date' => 'Debe ingresar una fecha válida.',
            'cover.image'           => 'La portada debe ser una imagen válida.',
        ]);

        $data = [
            'title'            => $request->input('title'),
            'price'            => $request->input('price'),
            'description'      => $request->input('description'),
            'publication_date' => $request->input('publication_date') ?? $book->publication_date,
            'author_fk'        => $request->input('author_fk') ?? $book->author_fk,
        ];

        if ($request->hasFile('cover')) {
            if ($book->cover !== null && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $data['cover'] = $request->file('cover')->store('books', 'public');
        }

        $book->update($data);

        $book->genres()->sync($request->input('genres', []));

        return redirect()
            ->route('books.admin')
            ->with('feedback.message', 'El libro <b>' . e($book->title) . '</b> se editó con éxito.')
            ->with('feedback.type', 'success');
    }

    public function delete(int $id)
    {
        $book = Book::findOrFail($id);

        return view('books.delete', [
            'book' => $book,
        ]);
    }

    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);

        $book->genres()->detach();

        if ($book->cover !== null && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()
            ->route('books.admin')
            ->with('feedback.message', 'El libro <b>' . e($book->title) . '</b> se eliminó con éxito.')
            ->with('feedback.type', 'success');
    }
}