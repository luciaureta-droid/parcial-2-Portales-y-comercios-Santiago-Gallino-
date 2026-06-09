<x-main-layout>
    <x-slot:title>Panel de Administración :: Blog</x-slot:title>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 fw-bold text-dark m-0"> Panel de Control: Noticias</h1>
                <p class="text-muted m-0">Espacio de administración para gestionar las publicaciones.</p>
            </div>
            <a href="{{ route('blog.create') }}" class="btn btn-success fw-bold">
                <i class="bi bi-plus-lg"></i> Redactar Nueva Noticia
            </a>
        </div>

        @if(session('status'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('status') }}</div>
        @endif

        <div class="card shadow-sm border-0 bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 100px;">Miniatura</th>
                            <th>Título de la Noticia</th>
                            <th>Autor</th>
                            <th>Fecha</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Portada" class="img-thumbnail" style="max-height: 50px;">
                                    @else
                                        <span class="text-muted small">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark">{{ $post->title }}</td>
                                <td class="text-secondary">{{ $post->author }}</td>
                                <td class="text-muted small">{{ $post->created_at->format('d/m/Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-sm btn-outline-primary fw-bold me-1">Editar</a>
                                    <a href="{{ route('blog.delete', $post->id) }}" class="btn btn-sm btn-outline-danger fw-bold">Eliminar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 text-muted">No tenés ninguna noticia publicada todavía en la base de datos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación de la Clase 12 --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-main-layout>