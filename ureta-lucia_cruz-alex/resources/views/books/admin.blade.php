<x-main-layout>
    <x-slot:title>Administración de Libros - Panel de Control</x-slot:title>

    <div class="container py-5">
        <div class="row align-items-center mb-4 mt-2">
            <div class="col-md-8 text-center text-md-start">
                <span class="text-uppercase fw-bold text-orange-icon small" style="letter-spacing: 2px;">Panel Administrative</span>
                <h1 class="display-5 fw-bold text-dark-blue mt-1 mb-0">Gestión de Libros</h1>
            </div>
            <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                {{-- Vinculamos la acción de cargar libro con su ruta real --}}
                <a href="{{ route('books.create') }}" class="btn btn-success px-4 py-2 shadow-sm fw-bold">
                     Cargar Nuevo Libro
                </a>
            </div>
        </div>

        {{-- Tabla del CRUD Administrativo --}}
        <div class="table-responsive bg-white p-3 rounded shadow-sm border">
            <table class="table table-striped table-hover align-middle m-0">
                <thead class="table-dark">
                    <tr>
                        <th>Portada</th>
                        <th>Título</th>
                        <th>Precio</th>
                        <th class="text-center">Acciones Administrativas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td style="width: 90px;">
                            {{-- <img src="{{ asset('covers/imagenes/' . ($book->cover ?? 'default.png')) }}" 
                                 alt="Portada de {{ $book->title }}" 
                                 class="img-thumbnail shadow-sm" 
                                 style="max-height: 70px; object-fit: cover;"> --}}
                            
                            @if($book->cover !== null && Storage::disk('public')->exists($book->cover))
                                <img
                                    src="{{ Storage::url($book->cover) }}"
                                    alt="{{ $book->cover_description ?? 'Portada de ' . $book->title }}"
                                    class="img-fluid book-cover shadow-sm"
                                >
                            @else
                                <div class="book-cover-placeholder">
                                    Sin portada
                                </div>
                            @endif


                        </td>

                        <td class="fw-bold text-dark-blue text-start fs-5">{{ $book->title }}</td>

                        <td class="fw-bold text-success fs-5">$ {{ number_format($book->price, 0, ',', '.') }}</td>

                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                {{-- Ver Detalle --}}
                                <a href="{{ route('books.show', ['id' => $book->id]) }}" class="btn btn-sm btn-warning text-white px-3 fw-bold">Ver</a>
                                
                                {{-- Editar --}}
                                <a href="{{ route('books.edit', ['id' => $book->id]) }}" class="btn btn-sm btn-secondary px-3">Editar</a>
                                
                                {{-- Eliminar (Modificado al estilo del profe: POST directo sin @method) --}}
                                <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST" onsubmit="return confirm('¿Seguro que querés eliminar el libro: {{ $book->title }}?');" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger px-3">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No hay libros cargados en el sistema actualmente.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Enlaces de paginación --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
</x-main-layout>