<?php
/** * Documentación de variables de entrada para optimizar el editor
 * @var \Illuminate\Database\Eloquent\Collection|array $posts 
 * @var array $searchParams 
 */
?>

<x-main-layout>
    {{-- Título de la pestaña utilizando slots y traducciones --}}
    <x-slot:title>@lang('Blog Articles')</x-slot:title>

    <h1 class="mb-3">@lang('Blog Articles')</h1>

    {{-- Enlace visible únicamente para usuarios autenticados --}}
    @auth
    <div class="mb-3">
        <a href="{{ route('blog.create') }}" class="btn btn-success">@lang('Publish a new article')</a>
    </div>
    @endauth

    {{-- Formulario de Filtrado / Buscador --}}
    <form action="{{ route('blog.index') }}" method="GET" class="mb-4">
        <h2 class="h4 mb-3">Filtrar Publicaciones</h2>

        <div class="mb-2">
            <label for="s_title" class="form-label">Buscar por Título</label>
            <input
                type="search"
                id="s_title"
                name="s_title"
                class="form-control"
                value="{{ $searchParams['s_title'] ?? null }}"
                placeholder="Escribí el título acá..."
            >
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <h2 class="visually-hidden">Listado de Artículos</h2>

    {{-- Comprobación si existen artículos cargados en la colección --}}
    @if($posts->isNotEmpty())
        @if(($searchParams['s_title'] ?? null) !== null)
        <p class="mb-3"><i>Mostrando resultados encontrados para: "<b>{{ $searchParams['s_title'] }}</b>".</i></p>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Copete</th>
                    <th>Autor Relacionado</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones Administrativas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    {{-- Acceso directo a propiedades del modelo Eloquent --}}
                    <td class="fw-bold">{{ $post->title }}</td>
                    
                    {{-- 🌟 MODIFICADO: Cambiamos 'summary' por 'description' para usar la columna real de la tabla books --}}
                    <td>{{ $post->description }}</td>
                    
                    {{-- Acceso seguro al nombre del autor por la relación belongsTo --}}
                    <td>
                        @if($post->author)
                            <span class="badge bg-secondary">{{ $post->author->name }}</span>
                        @elseif($post->autor)
                            <span class="badge bg-secondary">{{ $post->autor->name }}</span>
                        @else
                            <span class="text-muted italic">Sin autor asignado</span>
                        @endif
                    </td>
                    
                    <td>{{ $post->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            {{-- Vista pública del post --}}
                            <a href="{{ route('blog.show', ['id' => $post->id]) }}" class="btn btn-sm btn-primary">Ver</a>

                            {{-- Botones de edición y borrado protegidos por autenticación --}}
                            @auth
                            <a href="{{ route('blog.edit', ['id' => $post->id]) }}" class="btn btn-sm btn-secondary">Editar</a>
                            <a href="{{ route('blog.delete', ['id' => $post->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                            @endauth
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Renderizado automático de los enlaces de paginación --}}
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    @else
        <p class="alert alert-warning">No se encontraron artículos cargados que coincidan con "<b>{{ $searchParams['s_title'] ?? '' }}</b>".</p>
    @endif
</x-main-layout>