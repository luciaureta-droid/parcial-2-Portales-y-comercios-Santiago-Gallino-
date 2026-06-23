<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Author[]|\Illuminate\Database\Eloquent\Collection $authors */
?>

<x-main-layout>
    <x-slot:title>Cargar nuevo libro</x-slot:title>

    <h1 class="mb-3">Cargar Nuevo Libro</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">
            Hay errores en los datos del formulario. Por favor, revisalos y probá de nuevo.
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Campo Título --}}
        <div class="mb-3 text-start">
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
                value="{{ old('title') }}"
            >
            @error('title')
                <div class="text-danger" id="error_title">{{ $message }}</div>
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
                @error('price')
                aria-invalid="true"
                aria-errormessage="error_price"
                @enderror
                value="{{ old('price') }}"
            >
            @error('price')
                <div class="text-danger" id="error_price">{{ $message }}</div>
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
                @error('publication_date')
                aria-invalid="true"
                aria-errormessage="error_publication_date"
                @enderror
                value="{{ old('publication_date') }}"
            >
            @error('publication_date')
                <div class="text-danger" id="error_publication_date">{{ $message }}</div>
            @enderror
        </div>

        {{-- Desplegable para seleccionar Autor --}}
        <div class="mb-3 text-start">
            <label for="author_fk" class="form-label fw-bold">Autor:</label>
            <select
                id="author_fk"
                name="author_fk"
                class="form-select @error('author_fk') is-invalid @enderror"
                @error('author_fk')
                aria-invalid="true"
                aria-errormessage="error_author_fk"
                @enderror
            >
                <option value="">-- Elegí un autor --</option>
                @foreach($authors as $author)
                    <option
                        value="{{ $author->id }}"
                        @selected($author->id == old('author_fk'))
                    >
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_fk')
                <div class="text-danger" id="error_author_fk">{{ $message }}</div>
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
                @error('description')
                aria-invalid="true"
                aria-errormessage="error_description"
                @enderror
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger" id="error_description">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Portada --}}
        <div class="mb-3 text-start">
            <label for="cover" class="form-label fw-bold">Portada del libro:</label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control @error('cover') is-invalid @enderror"
                @error('cover')
                aria-invalid="true"
                aria-errormessage="error_cover"
                @enderror
            >
            @error('cover')
                <div class="text-danger" id="error_cover">{{ $message }}</div>
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
                @error('cover_description')
                aria-invalid="true"
                aria-errormessage="error_cover_description"
                @enderror
                value="{{ old('cover_description') }}"
            >
            @error('cover_description')
                <div class="text-danger" id="error_cover_description">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-start mt-4">
            <button type="submit" class="btn btn-primary px-4">Cargar Libro</button>
            <a href="{{ route('books.admin') }}" class="btn btn-secondary px-4 ms-2">Cancelar</a>
        </div>
    </form>
</x-main-layout>