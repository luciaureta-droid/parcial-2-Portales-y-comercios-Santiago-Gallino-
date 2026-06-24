<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>
<x-main-layout>
    <x-slot:title>Cargar Nuevo Libro</x-slot:title>

    {{-- Inyección tradicional del enlace de estilos en el head --}}
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('style.css') }}">
    </x-slot:head>

    <div class="container py-5" style="max-width: 700px;">
        {{-- Encabezado en Español corregido --}}
        <div class="mb-4 text-center text-sm-start">
            <span class="text-uppercase fw-bold text-orange-icon small" style="letter-spacing: 2px;">Panel de Administración</span>
            <h1 class="display-6 fw-bold text-dark-blue mt-1">Cargar Nuevo Libro</h1>
            <p class="text-muted">Completá los datos del formulario para dar de alta un libro en el catálogo.</p>
        </div>

        {{-- Alerta de errores global --}}
        @if($errors->any())
            <div class="alert alert-danger shadow-sm fw-bold mb-4 border-start border-4 border-danger">
                Hay errores en los datos del formulario. Por favor, revisalos y probá de nuevo.
            </div>
        @endif

        {{-- Contenedor principal que usa tu clase de style.css --}}
        <div class="form-container p-4 p-md-5">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                {{-- Campo: Título --}}
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold text-dark-blue">Título del Libro:</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        placeholder="Ej: Rayuela"
                    >
                    @error('title')
                        <div class="error-message-custom">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Fila de Bootstrap (Precio y Fecha) --}}
                <div class="row">
                    {{-- Campo: Precio --}}
                    <div class="col-md-6 mb-4">
                        <label for="price" class="form-label fw-bold text-dark-blue">Precio ($):</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold text-muted">$</span>
                            <input
                                type="text"
                                id="price"
                                name="price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}"
                                placeholder="Ej: 4500"
                            >
                        </div>
                        @error('price')
                            <div class="error-message-custom">{{ $message }}</div>
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
                                    @checked(in_array($genre->id, old('genres', [])))
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
                    



                    {{-- Campo: Fecha de Publicación --}}
                    <div class="col-md-6 mb-4">
                        <label for="publication_date" class="form-label fw-bold text-dark-blue">Fecha de Publicación:</label>
                        <input
                            type="date"
                            id="publication_date"
                            name="publication_date"
                            class="form-control @error('publication_date') is-invalid @enderror"
                            value="{{ old('publication_date') }}"
                        >
                        @error('publication_date')
                            <div class="error-message-custom">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ========================================================================= --}}
                {{-- SECCIÓN TRADICIONAL DE AUTOR --}}
                {{-- ========================================================================= --}}
                <div class="form-section-author p-4 mb-4 shadow-sm">
                    <h2 class="h6 fw-bold text-success mb-3 text-uppercase" style="letter-spacing: 0.5px;">Asignación de Autor</h2>
                    
                    {{-- Opción A: Seleccionar uno existente --}}
                    <div class="mb-3">
                        <label for="author_fk" class="form-label fw-bold text-muted small">Opción A: Seleccionar autor existente</label>
                        <select id="author_fk" name="author_fk" class="form-select @error('author_fk') is-invalid @enderror">
                            <option value="">-- Seleccioná un autor de la lista --</option>
                            @foreach($authors as $autor)
                                <option value="{{ $autor->id }}" @selected(old('author_fk') == $autor->id)>
                                    {{ $autor->name }} (ID: {{ $autor->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('author_fk')
                            <div class="error-message-custom">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center my-3 position-relative">
                        <hr class="text-muted">
                        <span class="badge bg-secondary text-uppercase fw-bold p-2 position-absolute top-50 start-50 translate-middle" style="font-size: 0.7rem; letter-spacing: 1px;">O BIEN</span>
                    </div>

                    {{-- Opción B: Crear uno nuevo --}}
                    <div class="mb-2">
                        <label for="new_author_name" class="form-label fw-bold text-dark-blue small">Opción B: Registrar un autor nuevo</label>
                        <input 
                            type="text" 
                            id="new_author_name" 
                            name="new_author_name" 
                            class="form-control @error('new_author_name') is-invalid @enderror" 
                            value="{{ old('new_author_name') }}"
                            placeholder="Ej: Julio Cortázar"
                        >
                        @error('new_author_name')
                            <div class="error-message-custom">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- ========================================================================= --}}

                {{-- Campo: Descripción --}}
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold text-dark-blue">Descripción / Sinopsis:</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Escribí una breve reseña del libro..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error-message-custom">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones de acción --}}
                <div class="d-flex gap-2 justify-content-end border-top pt-3">
                    <a href="{{ route('books.admin') }}" class="btn btn-outline-secondary px-4 fw-bold">Cancelar</a>
                    <button type="submit" class="btn btn-success btn-custom-save px-4 fw-bold">Guardar Libro</button>
                </div>
            </form>
        </div>
    </div>
</x-main-layout>