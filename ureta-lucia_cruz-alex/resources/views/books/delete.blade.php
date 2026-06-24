<?php
/** @var \App\Models\Book $book */
?>

<x-main-layout>
    <x-slot:title>Eliminar libro: {{ $book->title }}</x-slot:title>

    <h1 class="mb-3">Confirmación necesaria para eliminar</h1>

    <p>Estás por eliminar de manera definitiva el libro <b>{{ $book->title }}</b>.</p>
    <p>Esta acción <b>no es reversible</b>.</p>

    <hr class="mb-3">

    <h2 class="mb-3">{{ $book->title }}</h2>

    <dl class="mb-3">
        <dt><b>Precio</b></dt>
        <dd>$ {{ number_format($book->price, 0, ',', '.') }}</dd>

        <dt><b>Fecha de publicación</b></dt>
        <dd>{{ $book->publication_date }}</dd>

        <dt><b>Descripción</b></dt>
        <dd>{{ $book->description }}</dd>

        <dt><b>Autor</b></dt>
        <dd>{{ $book->author?->name ?? 'Sin autor asignado' }}</dd>
    </dl>

    @if($book->cover !== null && Storage::disk('public')->exists($book->cover))
        <div class="mb-3">
            <span class="fw-bold d-block mb-1">Portada:</span>
            <img
                src="{{ Storage::url($book->cover) }}"
                alt="Portada de {{ $book->title }}"
                class="img-fluid rounded"
                style="max-width: 250px;"
            >
        </div>
    @endif

    <hr class="mb-3">

    <h2 class="mb-3 text-danger">¿Seguro que querés eliminar este libro?</h2>

    <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger px-4">
            Sí, eliminar {{ $book->title }}
        </button>

        <a href="{{ route('books.admin') }}" class="btn btn-secondary px-4 ms-2">
            Cancelar y volver
        </a>
    </form>
</x-main-layout>