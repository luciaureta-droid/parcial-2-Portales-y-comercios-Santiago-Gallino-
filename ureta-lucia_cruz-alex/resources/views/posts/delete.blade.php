<x-main-layout>
    <x-slot:title>Confirmar Eliminación :: Admin</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 bg-white p-4 text-center">
                    <div class="text-danger mb-3">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem;"></i>
                    </div>
                    
                    <h1 class="h3 fw-bold text-dark mb-2">¿Confirmás que querés eliminar esta noticia?</h1>
                    <p class="text-muted mb-4">Esta acción no se puede deshacer de ninguna manera.</p>

                    {{-- Caja informativa con los datos de la noticia a borrar --}}
                    <div class="p-3 bg-light rounded text-start mb-4 border">
                        <p class="mb-1 text-muted small">Título:</p>
                        <p class="fw-bold text-dark mb-2">{{ $noticia->titulo }}</p>
                        <p class="mb-1 text-muted small">Autor:</p>
                        <p class="text-secondary mb-0">{{ $noticia->autor_noticia }}</p>
                    </div>

                    {{-- Formulario definitivo que viaja hacia el método destroy del controlador --}}
                    <form action="{{ route('blog.destroy', $noticia->id) }}" method="POST">
                        @csrf
                        @method('DELETE') {{-- Directiva obligatoria en Laravel para eliminar --}}

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('blog.index') }}" class="btn btn-secondary px-4 fw-semibold">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-danger px-4 fw-semibold shadow-sm">
                                <i class="bi bi-trash"></i> Eliminar Permanentemente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>