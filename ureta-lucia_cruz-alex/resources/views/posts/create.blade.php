<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Author[]|\Illuminate\Database\Eloquent\Collection $autores */

?>
<x-main-layout>
    <x-slot:title>Publicar artículo de autores</x-slot:title>

    <h1 class="mb-3">Publicar un nuevo artículo sobre autores</h1>

    {{-- El método any() retorna true si hubo algún mensaje de error. --}}
    @if($errors->any())
        <div class="alert alert-danger mb-3">Hay errores en los datos del formulario. Por favor, revisalos y probá de nuevo.</div>
    @endif

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Campo Título --}}
        <div class="mb-3 text-start">
            <label for="titulo" class="form-label fw-bold">Título:</label>
         
            <input
                type="text"
                id="titulo"
                name="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                @error('titulo')
                aria-invalid="true"
                aria-errormessage="error_titulo"
                @enderror
                value="{{ old('titulo') }}"
            >
            @error('titulo')
                <div class="text-danger" id="error_titulo">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Copete --}}
        <div class="mb-3 text-start">
            <label for="copete" class="form-label fw-bold">Copete:</label>
            <input
                type="text"
                id="copete"
                name="copete"
                class="form-control @error('copete') is-invalid @enderror"
                @error('copete')
                aria-invalid="true"
                aria-errormessage="error_copete"
                @enderror
                value="{{ old('copete') }}"
            >
            @error('copete')
                <div class="text-danger" id="error_copete">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Cuerpo de la Noticia --}}
        <div class="mb-3 text-start">
            <label for="cuerpo" class="form-label fw-bold">Cuerpo del artículo:</label>
            <textarea
                id="cuerpo"
                name="cuerpo"
                class="form-control @error('cuerpo') is-invalid @enderror"
                rows="5"
                @error('cuerpo')
                aria-invalid="true"
                aria-errormessage="error_cuerpo"
                @enderror
            >{{ old('cuerpo') }}</textarea>
            @error('cuerpo')
                <div class="text-danger" id="error_cuerpo">{{ $message }}</div>
            @enderror
        </div>

        {{-- Desplegable para seleccionar un Autor de la Base de Datos --}}
        <div class="mb-3 text-start">
            <label for="author_id" class="form-label fw-bold">Autor Relacionado:</label>
            <select
                id="author_id"
                name="author_id"
                class="form-select @error('author_id') is-invalid @enderror"
                @error('author_id')
                aria-invalid="true"
                aria-errormessage="error_author_id"
                @enderror
            >
                <option value="">-- Elegí un autor --</option>
                @foreach($autores as $autor)
                    <option
                        value="{{ $autor->id }}"
                        @selected($autor->id == old('author_id'))
                    >
                        {{ $autor->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="text-danger" id="error_author_id">{{ $message }}</div>
            @enderror
        </div>

        {{-- 🌟 NUEVO CAMPO: Agregar autor nuevo si no figura en la lista --}}
        <div class="mb-3 text-start bg-light p-3 rounded border">
            <label for="new_author_name" class="form-label fw-bold text-secondary">¿El autor no está en la lista? Escribilo acá:</label>
            <input
                type="text"
                id="new_author_name"
                name="new_author_name"
                class="form-control @error('new_author_name') is-invalid @enderror"
                @error('new_author_name')
                aria-invalid="true"
                aria-errormessage="error_new_author_name"
                @enderror
                value="{{ old('new_author_name') }}"
                placeholder="Nombre del autor nuevo..."
            >
            <div class="form-text text-muted">Si escribís un nombre acá, se creará el autor automáticamente y se ignorará la selección del menú de arriba.</div>
            @error('new_author_name')
                <div class="text-danger" id="error_new_author_name">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de Imagen --}}
        <div class="mb-3 text-start">
            <label for="imagen" class="form-label fw-bold">Imagen del artículo:</label>
            <input
                type="file"
                id="imagen"
                name="imagen"
                class="form-control @error('imagen') is-invalid @enderror"
                @error('imagen')
                aria-invalid="true"
                aria-errormessage="error_imagen"
                @enderror
            >
            @error('imagen')
                <div class="text-danger" id="error_imagen">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-start mt-4">
            <button type="submit" class="btn btn-primary px-4">Publicar</button>
            <a href="{{ route('blog.index') }}" class="btn btn-secondary px-4 ms-2">Cancelar</a>
        </div>
    </form>
</x-main-layout>