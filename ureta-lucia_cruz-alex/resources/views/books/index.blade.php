<x-main-layout>
    <x-slot:title>Catálogo de Libros - A&L Books</x-slot:title>

    <div class="container py-5">
        {{-- Encabezado --}}
        <div class="row align-items-center mb-5 mt-2">
            <div class="col-md-8 text-center text-md-start">
                <span class="text-uppercase fw-bold text-orange-icon small" style="letter-spacing: 2px;">Nuestra Colección</span>
                <h1 class="display-5 fw-bold text-dark-blue mt-1 mb-0">Libros Disponibles</h1>
            </div>
            {{-- @auth
            <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                <a href="{{ route('books.create') }}" class="btn btn-orange px-4 py-2 shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i>Publicar Nuevo Libro
                </a>
            </div>
            @endauth --}}
        </div>

        {{-- Grilla de Tarjetas Interactivas --}}
        <div class="row g-4 mb-5">
            @forelse($books as $book)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 book-card shadow-sm border-0 bg-white overflow-hidden">
                        
                        {{-- Portada con badge de precio y gris suave de fondo --}}
                        <div class="book-cover-wrapper position-relative p-4 bg-light-gray text-center">
                            <img src="{{ asset('covers/imagenes/' . ($book->cover ?? 'default.png')) }}" 
                                 alt="Portada de {{ $book->title }}" 
                                 class="img-fluid book-cover shadow-sm">
                            
                            <span class="position-absolute top-0 end-0 bg-dark-blue text-white fw-bold px-3 py-1 m-2 rounded-pill small">
                                $ {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Info del Libro --}}
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="fw-bold text-dark-blue mb-1 text-truncate-2" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h5>
                            <p class="text-muted small mb-3">A&L Selección</p>

                            <div class="mt-auto pt-2">
                                <a href="{{ route('books.show', ['id' => $book->id]) }}" class="btn btn-outline-custom w-100 py-2 btn-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-eye me-2"></i> Ver Detalle
                                </a>

                                {{-- Acciones Administrativas (Solo visibles si estás logueada) --}}
                                {{-- @auth
                                <div class="d-flex gap-2 mt-2 border-top pt-2 justify-content-between">
                                    <a href="{{ route('books.edit', ['id' => $book->id]) }}" class="btn btn-sm btn-link text-secondary text-decoration-none p-0">
                                        <i class="bi bi-pencil-square me-1"></i> Editar
                                    </a>
                                    <a href="{{ route('books.delete', ['id' => $book->id]) }}" class="btn btn-sm btn-link text-danger text-decoration-none p-0">
                                        <i class="bi bi-trash me-1"></i> Eliminar
                                    </a>
                                </div>
                                @endauth --}}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-light-gray rounded-3">
                        <i class="bi bi-book display-2 text-muted opacity-50 mb-3"></i>
                        <p class="text-secondary fs-5 mb-0">No hay libros cargados en el catálogo actualmente.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-main-layout>