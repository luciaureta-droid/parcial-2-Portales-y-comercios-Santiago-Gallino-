<?php
/** @var \App\Models\Post $post */
?>
<x-main-layout>
    <x-slot:title>Eliminar el artículo: {{ $post->title }}</x-slot:title>

    <h1 class="mb-3">Confirmación necesaria para eliminar</h1>

    <p>Estás por eliminar de manera definitiva el artículo <b>{{ $post->title }}</b>.</p>
    <p>Esta acción <b>no es reversible</b>, y requiere una confirmación.</p>
    <p>A continuación se muestran los datos del artículo para revisar.</p>

    <hr class="mb-3">

    <h2 class="mb-3">{{ $post->title }}</h2>

    {{-- Lista de datos del Post con la etiqueta <dl> que usa el profesor --}}
    <dl class="mb-3">
        <dt><b>Copete / Resumen</b></dt>
        <dd>{{ $post->summary }}</dd>
        
        <dt><b>Autor Relacionado</b></dt>
        <dd>{{ $post->author?->name ?? 'Sin autor asignado' }}</dd>
        
        <dt><b>Fecha de Creación</b></dt>
        <dd>{{ $post->created_at->format('d/m/Y H:i') }}</dd>
    </dl>

    @if($post->image !== null && \Storage::disk('public')->exists($post->image))
        <div class="mb-3">
            <span class="fw-bold d-block mb-1">Imagen del artículo:</span>
            <img src="{{ \Storage::url($post->image) }}" alt="Imagen de {{ $post->title }}" class="img-fluid rounded" style="max-width: 250px;">
        </div>
    @endif

    <hr class="mb-3">

    <h3 class="mb-2">Cuerpo de la noticia</h3>
    <div class="mb-3">{{ $post->content }}</div>

    <hr class="mb-3">

    <h2 class="mb-3 text-danger">¿Seguro que querés eliminar este artículo?</h2>

    {{-- Formulario que ejecuta la acción DELETE por método POST en Laravel con la directiva @method --}}
    <form action="{{ route('blog.destroy', ['id' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-danger px-4">Sí, eliminar {{ $post->title }}</button>
        <a href="{{ route('blog.index') }}" class="btn btn-secondary px-4 ms-2">Cancelar y volver</a>
    </form>
</x-main-layout>