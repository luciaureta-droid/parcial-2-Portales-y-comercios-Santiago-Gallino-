<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // 1. Capturamos el término que viene del buscador
        $s_title = $request->query('s_title');

        // 2. Iniciamos una consulta limpia sobre el modelo Post incluyendo su relación 'author'
        $query = Post::with('author');

        // 3. Filtro inteligente: Busca por título del post O por nombre del autor
        if (!empty($s_title)) {
            $query->where(function($q) use ($s_title) {
                // Busca coincidencia en el título del artículo
                $q->where('title', 'LIKE', "%{$s_title}%")
                  // O busca coincidencia en el nombre del autor usando la relación de Eloquent
                  ->orWhereHas('author', function($qAuthor) use ($s_title) {
                      $qAuthor->where('name', 'LIKE', "%{$s_title}%");
                  });
            });
        }

        // 4. Ordenamos por fecha y paginamos de a 5 como pide el ejercicio
        $posts = $query->orderBy('created_at', 'desc')->paginate(5);

        // 5. Armamos el array de parámetros para mantener el estado en la vista Blade
        $searchParams = [
            's_title' => $s_title
        ];

        // 6. Retornamos la vista enviando los posts y los parámetros de búsqueda
        return view('posts.index', compact('posts', 'searchParams'));
    }

    public function create()
    {
        $autores = Author::orderBy('name', 'asc')->get();

        return view('posts.create', compact('autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'          => 'required|max:100',
            'copete'          => 'required', 
            'cuerpo'          => 'nullable', 
            'author_id'       => 'required_without:new_author_name', 
            'new_author_name' => 'nullable|string|max:255',
            'imagen'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'titulo.required'            => 'El título del artículo es obligatorio.',
            'titulo.max'                 => 'El título no debe superar los :max caracteres.',
            'copete.required'            => 'El copete o resumen es obligatorio.',
            'author_id.required_without' => 'Debe asociar un autor de la lista o escribir uno nuevo abajo.',
            'imagen.image'               => 'El archivo debe ser una imagen válida.',
            'imagen.mimes'               => 'La imagen debe tener formato: jpg, jpeg o png.',
            'imagen.max'                 => 'La imagen no debe pesar más de 2MB.'
        ]);

        $inputData = $request->only(['titulo', 'copete', 'cuerpo', 'author_id']);

        $data = [
            'title'            => $inputData['titulo'],
            'description'      => $inputData['copete'], 
            'price'            => 0,
            'publication_date' => now()->format('Y-m-d'),
            'author_fk'        => $inputData['author_id'],
        ];

        if ($request->filled('new_author_name')) {
            $nuevoAutor = Author::create([
                'name'        => $request->input('new_author_name'),
                'nationality' => 'Desconocida',
                'birth_date'  => '1970-01-01',
                'biography'   => 'Sin biografía disponible.'
            ]);

            $data['author_fk'] = $nuevoAutor->id;
        }

        if ($request->hasFile('imagen')) {
            $filename = $request->file('imagen')->store('covers', 'public');
            $data['cover'] = $filename;
        }

        Post::create($data);

        return redirect()
            ->route('blog.index')
            ->with('status', 'Artículo publicado exitosamente.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        $autores = Author::orderBy('name', 'asc')->get();

        $post->summary = $post->description;
        $post->content = $post->cuerpo ?? ''; 
        $post->author_id = $post->author_fk;
        $post->image = $post->cover;

        return view('posts.edit', compact('post', 'autores'));
    }

    public function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'titulo'    => 'required|max:100',
            'copete'    => 'required', 
            'cuerpo'    => 'nullable', 
            'author_id' => 'required|integer', 
            'imagen'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'titulo.required'    => 'El título del artículo es obligatorio.',
            'titulo.max'         => 'El título no debe superar los :max caracteres.',
            'copete.required'    => 'El copete o resumen es obligatorio.',
            'author_id.required' => 'Debe asociar un autor al artículo.',
            'imagen.image'       => 'El archivo debe ser una imagen válida.',
            'imagen.mimes'       => 'La imagen debe tener formato: jpg, jpeg o png.',
            'imagen.max'         => 'La imagen no debe pesar más de 2MB.'
        ]);

        $inputData = $request->only(['titulo', 'copete', 'author_id']);

        $data = [
            'title'       => $inputData['titulo'],
            'description' => $inputData['copete'],
            'author_fk'   => $inputData['author_id'],
        ];

        if ($request->hasFile('imagen')) {
            $filename = $request->file('imagen')->store('covers', 'public');
            $data['cover'] = $filename;
            $oldCover = $post->cover; 
        }

        $post->update($data);

        if (isset($oldCover) && $oldCover !== null && Storage::disk('public')->exists($oldCover)) {
            Storage::disk('public')->delete($oldCover);
        }

        return redirect()
            ->route('blog.index')
            ->with('status', 'Artículo actualizado exitosamente.');
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos de Eliminación agregados para corregir el error
    |--------------------------------------------------------------------------
    */

    /**
     * Muestra la vista de confirmación de eliminación (GET)
     */
    public function delete(int $id)
    {
        // Buscamos el artículo por ID
        $post = Post::findOrFail($id);

        // Mapeamos las propiedades tal cual lo hacés en tu método edit()
        $post->summary = $post->description;
        $post->content = $post->cuerpo ?? ''; 
        $post->image = $post->cover;

        // Retornamos la vista de confirmación pasándole el post mapeado
        return view('posts.delete', compact('post'));
    }

    /**
     * Ejecuta la eliminación real en la base de datos (DELETE)
     */
    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);

        // Si tiene una imagen (cover) guardada en el disco público, la eliminamos
        if ($post->cover !== null && Storage::disk('public')->exists($post->cover)) {
            Storage::disk('public')->delete($post->cover);
        }

        // Eliminamos el registro de la base de datos
        $post->delete();

        return redirect()
            ->route('blog.index')
            ->with('status', 'El artículo fue eliminado con éxito.');
    }
}