<x-main-layout>
    <x-slot:title>{{ $book->title }} - Detalle del Libro</x-slot:title>

    <div class="container py-5">
        <div class="mb-4 text-start">
            <a href="javascript:history.back()" class="btn btn-outline-secondary px-3 py-2 btn-sm fw-bold">
                ⬅ Volver al listado
            </a>
        </div>

        <div class="row bg-white rounded shadow-sm border overflow-hidden p-4 g-4 align-items-center">
            <div class="col-md-4 text-center bg-light-gray py-4 rounded">
                @if($book->cover !== null && Storage::disk('public')->exists($book->cover))
                    <img
                        src="{{ Storage::url($book->cover) }}"
                        alt="{{ $book->cover_description ?? 'Portada de ' . $book->title }}"
                        class="img-fluid rounded shadow book-cover"
                    >
                @else
                    <div class="book-cover-placeholder">
                        Sin portada
                    </div>
                @endif
            </div>

            <div class="col-md-8 text-md-start text-center">
                <span class="text-uppercase fw-bold text-orange-icon small" style="letter-spacing: 2px;">
                    Detalle de la Obra
                </span>

                <h1 class="display-5 fw-bold text-dark-blue mt-1 mb-3">{{ $book->title }}</h1>

                <div class="mb-4">
                    <span class="fs-3 fw-bold text-success bg-light px-3 py-2 rounded border">
                        $ {{ number_format($book->price, 0, ',', '.') }}
                    </span>
                </div>

                <hr class="text-muted opacity-25">

                <div class="mb-3">
                    <p class="mb-2">
                        <strong>Autor:</strong>
                        {{ $book->author?->name ?? 'Sin autor asignado' }}
                    </p>

                    <p class="mb-2">
                        <strong>Géneros:</strong>
                        @forelse($book->genres as $genre)
                            <span class="badge bg-secondary me-1">{{ $genre->name }}</span>
                        @empty
                            <span class="text-muted">Sin géneros asignados</span>
                        @endforelse
                    </p>

                    <p class="mb-2">
                        <strong>Fecha de publicación:</strong>
                        {{ $book->publication_date ? \Carbon\Carbon::parse($book->publication_date)->format('d/m/Y') : 'Sin fecha cargada' }}
                    </p>
                </div>

                <hr class="text-muted opacity-25">

                <h3 class="h5 fw-bold text-dark-blue mt-4">Sinopsis o Resumen</h3>
                <p class="text-secondary fs-5 lh-base">
                    {{ $book->description ?? 'No hay un resumen disponible todavía para esta edición de la biblioteca.' }}
                </p>

                <div class="mt-4 pt-2">
                    <p class="mb-1 text-muted small">
                        <strong>Clasificación:</strong> A&L Selección Especial
                    </p>
                    <p class="mb-0 text-muted small">
                        <strong>Fecha de registro:</strong>
                        {{ $book->created_at ? $book->created_at->format('d/m/Y') : 'Hace mucho tiempo' }}
                    </p>
                </div>

                <hr class="text-muted opacity-25">

                <div class="mt-4">
                    @auth
                        <form action="{{ route('books.reserve', ['id' => $book->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                                📩 Reservar este libro (Enviar Email)
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning d-inline-block" role="alert">
                            Debés <a href="{{ route('login.show') }}" class="alert-link">iniciar sesión</a>
                            para poder reservar este libro y recibir la confirmación por correo.
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-main-layout>