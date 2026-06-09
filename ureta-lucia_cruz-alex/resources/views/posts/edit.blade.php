<x-main-layout>
    <x-slot:title>Editar Noticia :: Admin</x-slot:title>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-4">
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Volver al panel
                    </a>
                </div>

                <div class="card shadow-sm border-0 bg-white p-4">
                    <h1 class="h3 fw-bold text-dark mb-4">✏️ Editar Noticia</h1>

                    {{-- Formulario de edición. IMPORTANTE: apuntamos a 'update' con el ID de la noticia --}}
                    <form action="{{ route('blog.update', $noticia->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Directiva obligatoria en Laravel para modificaciones --}}

                        {{-- Campo Título --}}
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-semibold">Título de la noticia</label>
                            <input type="text" 
                                   id="titulo" 
                                   name="titulo" 
                                   class="form-control @error('titulo') is-invalid @enderror" 
                                   value="{{ old('titulo', $noticia->titulo) }}">
                            @error('titulo') {
                                <div class="invalid-feedback">{{ $message }}</div>
                            }
                            @enderror
                        </div>

                        {{-- Campo Copete --}}
                        <div class="mb-3">
                            <label for="copete" class="form-label fw-semibold">Copete / Resumen breve</label>
                            <textarea id="copete" 
                                      name="copete" 
                                      rows="2" 
                                      class="form-control @error('copete') is-invalid @enderror">{{ old('copete', $noticia->copete) }}</textarea>
                            @error('copete') {
                                <div class="invalid-feedback">{{ $message }}</div>
                            }
                            @enderror
                        </div>

                        {{-- Campo Cuerpo --}}
                        <div class="mb-3">
                            <label for="cuerpo" class="form-label fw-semibold">Cuerpo completo de la noticia</label>
                            <textarea id="cuerpo" 
                                      name="cuerpo" 
                                      rows="5" 
                                      class="form-control @error('cuerpo') is-invalid @enderror">{{ old('cuerpo', $noticia->cuerpo) }}</textarea>
                            @error('cuerpo') {
                                <div class="invalid-feedback">{{ $message }}</div>
                            }
                            @enderror
                        </div>

                        {{-- Campo Autor --}}
                        <div class="mb-3">
                            <label for="autor_noticia" class="form-label fw-semibold">Autor de la publicación</label>
                            <input type="text" 
                                   id="autor_noticia" 
                                   name="autor_noticia" 
                                   class="form-control @error('autor_noticia') is-invalid @enderror" 
                                   value="{{ old('autor_noticia', $noticia->autor_noticia) }}">
                            @error('autor_noticia') {
                                <div class="invalid-feedback">{{ $message }}</div>
                            }
                            @enderror
                        </div>

                        {{-- Vista previa de la imagen actual si existe --}}
                        @if($noticia->imagen) {
                            <div class="mb-3">
                                <p class="form-label fw-semibold mb-1">Imagen actual:</p>
                                <img src="{{ url('img/' . $noticia->imagen) }}" alt="Portada" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        }
                        @endif

                        {{-- Campo Imagen Nueva --}}
                        <div class="mb-4">
                            <label for="imagen" class="form-label fw-semibold">Cambiar imagen (Opcional)</label>
                            <input type="file" 
                                   id="imagen" 
                                   name="imagen" 
                                   class="form-control @error('imagen') is-invalid @enderror">
                            @error('imagen') {
                                <div class="invalid-feedback">{{ $message }}</div>
                            }
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning fw-bold py-2 text-dark shadow-sm">
                                <i class="bi bi-check-circle"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>