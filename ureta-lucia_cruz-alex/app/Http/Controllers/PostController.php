<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // Traemos las noticias de forma paginada para la tabla de administración
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validamos usando las claves correspondientes a los "name" de tus inputs
        $request->validate([
            'titulo'        => 'required|max:255',
            'copete'        => 'required|max:255',
            'cuerpo'        => 'required',
            'autor_noticia' => 'required|max:100',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Estructuramos el array para guardar en el modelo
        $data = [
            'title'        => $request->input('titulo'),
            'summary'      => $request->input('copete'), // Ajustalo según los campos de tu base de datos
            'content'      => $request->input('cuerpo'),
            'author'       => $request->input('autor_noticia'),
        ];

        // Procesamos la subida de la foto usando File Storage (Clase 10)
        if ($request->hasFile('imagen')) {
            $data['image'] = $request->file('imagen')->store('blog_images', 'public');
        }

        Post::create($data);

        // Volvemos al panel de control con un mensaje de éxito
        return redirect()->route('blog.index')->with('status', '¡Noticia publicada exitosamente!');
    }
} // Fin del controlador PostController