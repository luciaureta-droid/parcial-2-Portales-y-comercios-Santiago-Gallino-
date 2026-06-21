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
            {{--
            El helper old() de Laravel permite obtener el valor previo de un campo de formulario
            que haya sido guardado en la sesión por el validate().

            ## Errores accesibles (Atributos ARIA obligatorios por Gallino)
            - aria-invalid: Indica si el campo tiene un valor incorrecto (true/false).
            - aria-errormessage: Lleva el id del div que contiene el texto de error.
            --}}
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