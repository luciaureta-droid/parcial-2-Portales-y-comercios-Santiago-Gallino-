<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Book $book */
?>

<x-main-layout>
    <x-slot:title>Editar libro: {{ $book->title }}</x-slot:title>

    <h1 class="mb-3">Editar Libro</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">
            Hay errores en los datos del formulario. Por favor, revisalos y probá de nuevo.
        </div>
    @endif

    <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Campo Título --}}
        <div class="mb-3 text-start">
            <label for="title" class="form-label fw-bold">Título:</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $book->title) }}"
            >
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Precio --}}
        <div class="mb-3 text-start">
            <label for="price" class="form-label fw-bold">Precio:</label>
            <input
                type="number"
                id="price"
                name="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $book->price) }}"
            >
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Fecha de Publicación --}}
        <div class="mb-3 text-start">
            <label for="publication_date" class="form-label fw-bold">Fecha de publicación:</label>
            <input
                type="date"
                id="publication_date"
                name="publication_date"
                class="form-control @error('publication_date') is-invalid @enderror"
                value="{{ old('publication_date', $book->publication_date) }}"
            >
            @error('publication_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Descripción --}}
        <div class="mb-3 text-start">
            <label for="description" class="form-label fw-bold">Descripción:</label>
            <textarea
                id="description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="5"
            >{{ old('description', $book->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Visualización de portada actual --}}
        <div class="mb-3 text-start">
            <div class="fw-bold mb-1">Portada actual:</div>

            @if($book->cover !== null && \Storage::disk('public')->exists($book->cover))
                <div class="mb-2">
                    <img
                        src="{{ \Storage::url($book->cover) }}"
                        alt="{{ $book->cover_description ?? 'Portada de ' . $book->title }}"
                        class="img-fluid rounded"
                        style="max-width: 300px;"
                    >
                </div>
            @else
                <p class="text-muted italic">Este libro no cuenta con una portada actualmente.</p>
            @endif
        </div>

        {{-- Campo para Cargar Nueva Portada --}}
        <div class="mb-3 text-start">
            <label for="cover" class="form-label fw-bold">Cambiar portada (Opcional):</label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control @error('cover') is-invalid @enderror"
                aria-describedby="help_cover"
            >
            <div id="help_cover" class="form-text">
                Solo elegí un archivo si deseás reemplazar la portada actual.
            </div>
            @error('cover')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descripción de portada --}}
        <div class="mb-3 text-start">
            <label for="cover_description" class="form-label fw-bold">Descripción de portada:</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control @error('cover_description') is-invalid @enderror"
                value="{{ old('cover_description', $book->cover_description) }}"
            >
            @error('cover_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-start mt-4">
            <button type="submit" class="btn btn-primary px-4">Actualizar Libro</button>
            <a href="{{ route('books.admin') }}" class="btn btn-secondary px-4 ms-2">Cancelar</a>
        </div>
    </form>
</x-main-layout>