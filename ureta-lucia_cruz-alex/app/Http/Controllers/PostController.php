<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Author; // Traemos el modelo de Autores
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // Traemos los libros de forma paginada para la tabla de administración
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Buscamos los autores ordenados por nombre y se los mandamos a la vista
        $autores = Author::orderBy('name', 'asc')->get();

        return view('posts.create', compact('autores'));
    }

    public function store(Request $request)
    {
        // Validamos usando las claves que vienen de tus inputs de la vista
        $request->validate([
            'titulo'    => 'required|max:100',
            'copete'    => 'required', 
            'cuerpo'    => 'nullable', 
            'author_id' => 'required|exists:authors,id', 
            'imagen'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Adaptamos el guardado a las columnas reales de tu tabla 'books'
        $data = [
            'title'            => $request->input('titulo'),
            'description'      => $request->input('copete'), // Tu copete se guarda en la columna 'description'
            'price'            => 1500,                      // Valor numérico por defecto requerido por tu BD
            'publication_date' => now()->format('Y-m-d'),    // Fecha de hoy requerida por tu BD
            'author_fk'        => $request->input('author_id'), // Guardamos el ID en la clave foránea real
        ];

        // Procesamos la subida de la foto usando la columna 'cover' de los libros
        if ($request->hasFile('imagen')) {
            $data['cover'] = $request->file('imagen')->store('covers', 'public');
        }

        Post::create($data);

        // Volvemos al panel de control con un mensaje de éxito
        return redirect()->route('blog.index')->with('status', '¡Libro publicado exitosamente!');
    }

    /**
     * 🌟 ESTO ES LO QUE TE FALTABA AGREGAR: Muestra el detalle de un libro individual
     */
    public function show($id)
    {
        // Buscamos el libro por su ID. Si no existe, tira error 404 de forma segura.
        $post = Post::findOrFail($id);

        // Retornamos la vista de detalle pasándole el objeto $post
        return view('posts.show', compact('post'));
    }
} // Fin del controlador PostController