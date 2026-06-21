<?php
/** @var \App\Models\Post $post */
?>
<x-main-layout>
    <x-slot:title>{{ $post->title }}</x-slot:title>

    <div class="contenedor-detalle">
        <a href="{{ route('blog.index') }}" class="btn-volver">⬅️ Volver al listado</a>

        <div class="tarjeta-libro">
            <div class="seccion-portada">
                @if($post->cover !== null && \Storage::exists($post->cover))
                    <img src="{{ \Storage::url($post->cover) }}" alt="{{ $post->cover_description ?? 'Portada de ' . $post->title }}" class="imagen-portada">
                @else
                    <div class="sin-portada">
                        <span>📖<br>Sin portada</span>
                    </div>
                @endif
            </div>

            <div class="seccion-info">
                <h1 class="titulo-libro">{{ $post->title }}</h1>
                
                <dl class="ficha-tecnica">
                    <dt>Precio</dt>
                    <dd class="precio-destacado">$ {{ number_format($post->price, 2, ',', '.') }}</dd>
                    
                    <dt>Fecha de publicación</dt>
                    <dd>{{ \Carbon\Carbon::parse($post->publication_date)->format('d/m/Y') }}</dd>
                    
                    <dt>Autor</dt>
                    <dd>
                        @if($post->author)
                            <span class="etiqueta-autor">{{ $post->author->name }}</span>
                        @elseif($post->autor)
                            <span class="etiqueta-autor">{{ $post->autor->name }}</span>
                        @else
                            <span class="sin-autor">Sin autor asignado</span>
                        @endif
                    </dd>
                </dl>

                <hr class="separador">

                <h2 class="subtitulo-sinopsis">Sinopsis / Descripción</h2>
                <div class="texto-descripcion">{{ $post->description ?? 'Este libro no posee una descripción disponible todavía.' }}</div>
            </div>
        </div>
    </div>
</x-main-layout>