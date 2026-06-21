<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\Models\Post $post */
/** @var \App\Models\Author[]|\Illuminate\Database\Eloquent\Collection $autores */
?>
<x-main-layout>
    <x-slot:title>Editar el artículo: {{ $post->title }}</x-slot:title>

    <h1 class="mb-3">Editar Artículo</h1>

    @if($errors->any())
        <div class="alert alert-danger mb-3">Hay errores en los datos del formulario. Por favor, revisalos y probá de nuevo.</div>
    @endif

    <form action="{{ route('blog.update', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                value="{{ old('titulo', $post->title) }}"
            >
            @error('titulo')
                <div class="text-danger" id="error_titulo">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Copete / Copete Noticia --}}
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
                value="{{ old('copete', $post->summary) }}"
            >
            @error('copete')
                <div class="text-danger" id="error_copete">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo Cuerpo de la Noticia --}}
        <div class="mb-3 text-start">
            <label for="cuerpo" class="form-label fw-bold">Cuerpo de la noticia:</label>
            <textarea
                id="cuerpo"
                name="cuerpo"
                class="form-control @error('cuerpo') is-invalid @enderror"
                rows="5"
                @error('cuerpo')
                aria-invalid="true"
                aria-errormessage="error_cuerpo"
                @enderror
            >{{ old('cuerpo', $post->content) }}</textarea>
            @error('cuerpo')
                <div class="text-danger" id="error_cuerpo">{{ $message }}</div>
            @enderror
        </div>

        {{-- Desplegable de Autores Relacionados (Con la directiva @selected de Gallino) --}}
        <div class="mb-3 text-start">
            <label for="author_id" class="form-label fw-bold">Seleccionar Autor Relacionado:</label>
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
                        @selected($autor->id == old('author_id', $post->author_id))
                    >
                        {{ $autor->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="text-danger" id="error_author_id">{{ $message }}</div>
            @enderror
        </div>

        {{-- Visualización de la Imagen Actual (Punto obligatorio del parcial) --}}
        <div class="mb-3 text-start">
            <div class="fw-bold mb-1">Imagen actual:</div>
            @if($post->image !== null && \Storage::disk('public')->exists($post->image))
                <div class="mb-2">
                    <img src="{{ \Storage::url($post->image) }}" alt="Imagen de {{ $post->title }}" class="img-fluid rounded" style="max-width: 300px;">
                </div>
            @else
                <p class="text-muted italic">Este artículo no cuenta con una imagen actualmente.</p>
            @endif
        </div>

        {{-- Campo para Cargar Nueva Imagen --}}
        <div class="mb-3 text-start">
            <label for="imagen" class="form-label fw-bold">Cambiar Imagen (Opcional):</label>
            <input
                type="file"
                id="imagen"
                name="imagen"
                class="form-control @error('imagen') is-invalid @enderror"
                aria-describedby="help_imagen"
                @error('imagen')
                aria-invalid="true"
                aria-errormessage="error_imagen"
                @enderror
            >
            <div id="help_imagen" class="form-text">Solo elegí un archivo si deseás reemplazar la imagen actual del blog.</div>
            @error('imagen')
                <div class="text-danger" id="error_imagen">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-start mt-4">
            <button type="submit" class="btn btn-primary px-4">Actualizar Artículo</button>
            <a href="{{ route('blog.index') }}" class="btn btn-secondary px-4 ms-2">Cancelar</a>
        </div>
    </form>
</x-main-layout>