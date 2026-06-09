<x-main-layout>
    <x-slot:title>Nueva Noticia :: Admin</x-slot:title>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-4">
                    {{-- Botón para volver atrás --}}
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Volver al panel
                    </a>
                </div>

                <div class="card shadow-sm border-0 bg-white p-4">
                    <h1 class="h3 fw-bold text-dark mb-4">✍️ Publicar Nueva Noticia</h1>

                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Campo Título --}}
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-semibold">Título de la noticia</label>
                            <input type="text" 
                                   id="titulo" 
                                   name="titulo" 
                                   class="form-control @error('titulo') is-invalid @enderror" 
                                   value="{{ old('titulo') }}">
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Copete --}}
                        <div class="mb-3">
                            <label for="copete" class="form-label fw-semibold">Copete / Resumen breve</label>
                            <textarea id="copete" 
                                      name="copete" 
                                      rows="2" 
                                      class="form-control @error('copete') is-invalid @enderror">{{ old('copete') }}</textarea>
                            @error('copete')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Cuerpo --}}
                        <div class="mb-3">
                            <label for="cuerpo" class="form-label fw-semibold">Cuerpo completo de la noticia</label>
                            <textarea id="cuerpo" 
                                      name="cuerpo" 
                                      rows="5" 
                                      class="form-control @error('cuerpo') is-invalid @enderror">{{ old('cuerpo') }}</textarea>
                            @error('cuerpo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Autor --}}
                        <div class="mb-3">
                            <label for="autor_noticia" class="form-label fw-semibold">Autor de la publicación</label>
                            <input type="text" 
                                   id="autor_noticia" 
                                   name="autor_noticia" 
                                   class="form-control @error('autor_noticia') is-invalid @enderror" 
                                   value="{{ old('autor_noticia') }}">
                            @error('autor_noticia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Imagen --}}
                        <div class="mb-4">
                            <label for="imagen" class="form-label fw-semibold">Imagen ilustrativa (Opcional)</label>
                            <input type="file" 
                                   id="imagen" 
                                   name="imagen" 
                                   class="form-control @error('imagen') is-invalid @enderror">
                            @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold py-2">
                                <i class="bi bi-cloud-arrow-up"></i> Publicar Noticia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>