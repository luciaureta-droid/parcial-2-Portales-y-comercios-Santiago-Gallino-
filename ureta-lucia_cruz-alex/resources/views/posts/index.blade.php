<?php
/** @var \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts */
/** @var array $searchParams */
?>

<x-main-layout>
    {{-- Título de la pestaña utilizando la lógica del profe --}}
    <x-slot:title>Artículos del Blog</x-slot:title>

    <h1 class="mb-4 fw-bold main-blog-title text-center">Artículos del Blog</h1>

    {{-- Enlace visible únicamente para usuarios autenticados con redirección limpia --}}
    @auth
    <div class="mb-4 text-center">
        <a href="{{ url('/blog/nuevo') }}" class="btn btn-success fw-bold px-4">Publicar un nuevo artículo</a>
    </div>
    @endauth

    {{-- Formulario de Filtrado / Buscador exacto al formato del profe --}}
    <div class="card p-4 border-0 shadow-sm mb-5 filter-news-card mx-auto">
        <form action="{{ route('blog.index') }}" method="GET">
            <h2 class="h5 mb-3 fw-semibold text-center text-muted">Filtrar Publicaciones</h2>

            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center align-items-center">
                <div class="w-100 flex-grow-1" style="max-width: 450px;">
                    <label for="s_title" class="form-label visually-hidden">Buscar por Título</label>
                    <input
                        type="search"
                        id="s_title"
                        name="s_title"
                        class="form-control rounded-pill px-3 input-search-blog"
                        value="{{ $searchParams['s_title'] ?? null }}"
                        placeholder="Escribí el título acá..."
                    >
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4 btn-search-blog fw-bold">Buscar</button>
            </div>
        </form>
    </div>

    <h2 class="visually-hidden">Listado de Artículos</h2>

    {{-- Comprobación si existen artículos en la colección --}}
    @if($posts->isNotEmpty())
        {{-- Validación de texto buscado idéntica a la del profesor --}}
        @if(($searchParams['s_title'] ?? null) !== null)
            <p class="mb-4 text-center"><i>Se muestran los resultados para "<b>{{ $searchParams['s_title'] }}</b>".</i></p>
        @endif

        {{-- Grid de cajas de noticias estilizado por CSS externo --}}
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
            @foreach($posts as $post)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm custom-news-box">
                        
                        <div class="card-body d-flex flex-column p-4">
                            
                            {{-- Insignia del Autor (Relación por Eloquent) --}}
                            <div class="mb-3">
                                @if($post->author)
                                    <span class="badge rounded-pill bg-secondary px-3 py-2 text-white author-news-badge">{{ $post->author->name }}</span>
                                @elseif($post->autor)
                                    <span class="badge rounded-pill bg-secondary px-3 py-2 text-white author-news-badge">{{ $post->autor->name }}</span>
                                @else
                                    <span class="text-muted fst-italic text-sm">Sin autor asignado</span>
                                @endif
                            </div>

                            {{-- Título de la caja --}}
                            <h3 class="card-title h5 fw-bold mb-3 title-news-box">
                                {{ $post->title }}
                            </h3>

                            {{-- Copete / Descripción Breve --}}
                            <p class="card-text text-muted flex-grow-1 mb-4 text-justify description-news-box">
                                {{ Str::limit($post->description, 180, '...') }}
                            </p>

                            {{-- Pie de la caja: Fecha y Botones de Acción --}}
                            <div class="pt-3 border-top border-light mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-secondary date-news-text">
                                        {{ $post->created_at->format('d/m/Y') }}
                                    </small>
                                    
                                    <a href="{{ route('blog.show', ['id' => $post->id]) }}" class="btn btn-sm btn-primary rounded-pill px-3 btn-view-news fw-bold">Ver</a>
                                </div>

                                {{-- Acciones administrativas protegidas por @auth igual que el profe --}}
                                @auth
                                <div class="d-flex gap-1 justify-content-end mt-2 pt-2 border-top border-dashed">
                                    <a href="{{ route('blog.edit', ['id' => $post->id]) }}" class="btn btn-sm btn-outline-secondary btn-admin-box">Editar</a>
                                    <a href="{{ route('blog.delete', ['id' => $post->id]) }}" class="btn btn-sm btn-outline-danger btn-admin-box">Eliminar</a>
                                </div>
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginación automática conservando la consulta del buscador --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->withQueryString()->links() }}
        </div>
    @else
        {{-- Mensaje de no resultados adaptado al estilo limpio del profe --}}
        <p class="alert alert-warning shadow-sm rounded-3">
            No se encontraron resultados para la búsqueda "<b>{{ $searchParams['s_title'] ?? '' }}</b>".
        </p>
    @endif
</x-main-layout>