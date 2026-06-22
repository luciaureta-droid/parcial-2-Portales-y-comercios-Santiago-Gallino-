<?php
/**
 * Documentación de variables de entrada para optimizar el editor
 * @var \Illuminate\Database\Eloquent\Collection|array $authors
 */
?>

<x-main-layout>
    <x-slot:title>Blog de Autores</x-slot:title>

    <h1 class="mb-3">Blog de Autores</h1>

    {{-- Enlace visible únicamente para usuarios autenticados --}}
    @auth
    <div class="mb-3">
        {{-- Por ahora lo dejamos comentado hasta confirmar la ruta del ABM de autores --}}
        {{-- <a href="{{ route('authors.create') }}" class="btn btn-success">Cargar nuevo autor</a> --}}
    </div>
    @endauth

    <h2 class="visually-hidden">Listado de Autores</h2>

    @if($authors->isNotEmpty())
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Autor</th>
                    <th>Nacionalidad</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Biografía</th>
                    <th>Libros Relacionados</th>
                </tr>
            </thead>

            <tbody>
                @foreach($authors as $author)
                <tr>
                    <td>
                        @if($author->photo)
                            <img
                                src="{{ asset('storage/' . $author->photo) }}"
                                alt="{{ $author->photo_description ?? 'Foto de ' . $author->name }}"
                                style="width: 80px; height: 80px; object-fit: cover;"
                            >
                        @else
                            <span class="text-muted">Sin foto</span>
                        @endif
                    </td>

                    <td class="fw-bold">{{ $author->name }}</td>

                    <td>{{ $author->nationality }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($author->birth_date)->format('d/m/Y') }}
                    </td>

                    <td>{{ $author->biography }}</td>

                    <td>
                        @if($author->books->isNotEmpty())
                            @foreach($author->books as $book)
                                <span class="badge bg-secondary mb-1">{{ $book->title }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">Sin libros relacionados</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="alert alert-warning">No hay autores cargados actualmente.</p>
    @endif
</x-main-layout>