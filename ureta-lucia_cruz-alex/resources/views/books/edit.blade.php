<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Book $book */
?>

<x-main-layout>
    <x-slot:title>Editar el Libro: {{ $book->title }}</x-slot:title>

    <h1 class="mb-3 text-start fw-bold text-dark-blue">Editar {{ $book->title }}</h1>

    {{-- Alerta general de errores en el formulario idéntica al docente --}}
    @if($errors->any())
        <div class="alert alert-danger mb-3 text-start">
            Hay errores en los datos del formulario. Por favor, revisalos y probá de nuevo.
        </div>
    @endif

    {{-- Modificado al estilo del profe: POST directo y con soporte para subir portadas (enctype) --}}
    <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data" class="text-start">
        @csrf
        @method('PUT') {{-- el @method('PUT') para evitar el error de método no soportado --}}

        {{-- Campo: Título --}}
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Título:</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                @error('title')
                aria-invalid="true"
                aria-errormessage="error_title"
                @enderror
                value="{{ old('title', $book->title) }}"
            >
            @error('title')
                <div class="text-danger mt-1 small" id="error_title">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo: Precio --}}
        <div class="mb-3">
            <label for="price" class="form-label fw-bold">Precio:</label>
            <input
                type="text"
                id="price"
                name="price"
                class="form-control @error('price') is-invalid @enderror"
                @error('price')
                aria-invalid="true"
                aria-errormessage="error_price"
                @enderror
                value="{{ old('price', $book->price) }}"
            >
            @error('price')
                <div class="text-danger mt-1 small" id="error_price">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Géneros:</label>
                
            @foreach($genres as $genre)
                <div class="form-check">
                    <input
                        type="checkbox"
                        id="genre_{{ $genre->id }}"
                        name="genres[]"
                        value="{{ $genre->id }}"
                        class="form-check-input"
                        @checked(in_array(
                            $genre->id,
                            old('genres', $book->genres->pluck('id')->toArray())
                        ))
                    >
                
                    <label for="genre_{{ $genre->id }}" class="form-check-label">
                        {{ $genre->name }}
                    </label>
                </div>
            @endforeach
            
            @error('genres')
                <div class="text-danger mt-1 small">{{ $message }}</div>
            @enderror
        </div>




        {{-- Campo: Descripción / Sinopsis --}}
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Sinopsis:</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                class="form-control @error('description') is-invalid @enderror"
                @error('description')
                aria-invalid="true"
                aria-errormessage="error_description"
                @enderror
            >{{ old('description', $book->description) }}</textarea>
            @error('description')
                <div class="text-danger mt-1 small" id="error_description">{{ $message }}</div>
            @enderror
        </div>

        {{-- Control de Portada Actual (Inspirado en el código de películas del profe) --}}
        <div class="mb-3">
            <div class="fw-bold mb-2">Portada actual:</div>
            {{-- @if($book->cover !== null)
                <img src="{{ asset('covers/imagenes/' . $book->cover) }}" alt="Portada de {{ $book->title }}" class="img-thumbnail shadow-sm mb-2" style="max-height: 150px; object-fit: cover;">
            @else
                <p class="text-muted fst-italic small">No tiene una portada actualmente asignada.</p>
            @endif --}}
            
            @if($book->cover !== null && Storage::disk('public')->exists($book->cover))
                <img
                    src="{{ Storage::url($book->cover) }}"
                    alt="Portada de {{ $book->title }}"
                    class="img-thumbnail shadow-sm mb-2"
                    style="max-height: 150px; object-fit: cover;"
                >
            @else
                <p class="text-muted fst-italic small">No tiene una portada actualmente asignada.</p>
            @endif
        </div>

        {{-- Campo para subir nueva Portada --}}
        <div class="mb-4">
            <label for="cover" class="form-label fw-bold">Cambiar Portada:</label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control @error('cover') is-invalid @enderror"
                aria-describedby="help_cover"
                @error('cover')
                aria-invalid="true"
                aria-errormessage="error_cover"
                @enderror
            >
            <div id="help_cover" class="form-text text-muted">Solo elegí una portada si querés cambiar la imagen actual del libro.</div>
            @error('cover')
                <div class="text-danger mt-1 small" id="error_cover">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones de Acción integrados --}}
        <div class="d-flex gap-2 pt-2">
            <button type="submit" class="btn btn-primary px-4 fw-bold">Guardar Cambios</button>
            <a href="{{ route('books.admin') }}" class="btn btn-secondary px-4">Cancelar</a>
        </div>
    </form>
</x-main-layout>