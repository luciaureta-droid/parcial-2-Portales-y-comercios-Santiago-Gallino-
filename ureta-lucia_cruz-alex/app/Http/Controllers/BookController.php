<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', [
            'books' => $books,
        ]);
    }

    /* public function show(int $id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', [
            'book' => $book,
        ]);
    } */

    public function show(int $id)
    {
        $book = Book::with(['genres', 'author'])->findOrFail($id);

        return view('books.show', [
            'book' => $book,
        ]);
    }
}
