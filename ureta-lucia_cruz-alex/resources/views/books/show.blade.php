<x-main-layout>
    <x-slot:title>{{ $book->title }}</x-slot:title>

    <div class="container py-5">

        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary mb-4">
            ← Volver al listado
        </a>

        <div class="card shadow-sm p-4">

            <div class="row align-items-center">

                {{-- COLUMNA IZQUIERDA: PORTADA --}}
                <div class="col-md-4 text-center">
                    @if($book->cover !== null && Storage::disk('public')->exists($book->cover))
                        <img
                            src="{{ Storage::url($book->cover) }}"
                            alt="{{ $book->cover_description ?? 'Portada de ' . $book->title }}"
                            class="book-cover"
                        >
                    @else
                        <div class="book-cover-placeholder">
                            Sin portada
                        </div>
                    @endif
                </div>

                {{-- COLUMNA DERECHA: DATOS --}}
                <div class="col-md-8 text-start">

                    <p class="text-uppercase fw-bold section-title mb-2">
                        Detalle de la obra
                    </p>

                    <h1 class="display-4 fw-bold mb-3">
                        {{ $book->title }}
                    </h1>

                    <div class="mb-4">
                        <span class="badge bg-success fs-4 p-3">
                            $ {{ number_format($book->price, 0, ',', '.') }}
                        </span>
                    </div>

                    <hr>

                    <h3 class="fw-bold mt-4 mb-3 text-start">
                        Sinopsis o Resumen
                    </h3>
                    
                    <p class="fs-5 text-muted text-start">
                        {{ $book->description }}
                    </p>

                    <div class="mt-4">
                        <p>
                            <strong>Fecha de publicación:</strong>
                            {{ \Carbon\Carbon::parse($book->publication_date)->format('d/m/Y') }}
                        </p>

                        <p>
                            <strong>Fecha de registro:</strong>
                            {{ $book->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-main-layout>