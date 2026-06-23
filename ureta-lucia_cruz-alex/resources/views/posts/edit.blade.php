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

        {{-- Campo Título --}}
        <div class="mb-3 text-start">
            <label for="titulo" class="form-label fw-bold">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}"
                @if($errors->has('titulo'))
                aria-invalid="true"
                aria-errormessage="error_titulo"
                @endif
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
                class="form-control {{ $errors->has('copete') ? 'is-invalid' : '' }}"
                @if($errors->has('copete'))
                aria-invalid="true"
                aria-errormessage="error_copete"
                @endif
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
                class="form-control {{ $errors->has('cuerpo') ? 'is-invalid' : '' }}"
                rows="5"
                @if($errors->has('cuerpo'))
                aria-invalid="true"
                aria-errormessage="error_cuerpo"
                @endif
            >{{ old('cuerpo', $post->content) }}</textarea>
            @error('cuerpo')
                <div class="text-danger" id="error_cuerpo">{{ $message }}</div>
            @enderror
        </div>

        {{-- Desplegable de Autores Relacionados --}}
        <div class="mb-3 text-start">
            <label for="author_id" class="form-label fw-bold">Seleccionar Autor Relacionado:</label>
            <select
                id="author_id"
                name="author_id"
                class="form-select {{ $errors->has('author_id') ? 'is-invalid' : '' }}"
                @if($errors->has('author_id'))
                aria-invalid="true"
                aria-errormessage="error_author_id"
                @endif
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

        {{-- Visualización de la Imagen Actual --}}
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
                class="form-control {{ $errors->has('imagen') ? 'is-invalid' : '' }}"
                aria-describedby="help_imagen"
                @if($errors->has('imagen'))
                aria-invalid="true"
                aria-errormessage="error_imagen"
                @endif
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