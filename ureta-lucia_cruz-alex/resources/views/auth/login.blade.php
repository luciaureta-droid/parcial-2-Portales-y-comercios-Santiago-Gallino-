<x-main-layout>
    <x-slot:title>Ingresar a mi cuenta - A&L Books</x-slot:title>

    <div class="container py-5">
        {{-- Ajustamos las columnas para que en celular ocupe el 12 (todo el ancho) y en compu el 5 centrado --}}
        <div class="row justify-content-center w-100 m-0">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5">
                
                {{-- Encabezado del login --}}
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-dark-blue h2">Ingresar a A&L Books</h1>
                    <p class="text-muted small">Panel de Gestión Comercial</p>
                </div>

                {{-- Tarjeta del Formulario --}}
                <div class="card login-card p-4 shadow-sm border-0">
                    <div class="card-body p-0">
                        {{-- El action ahora apunta a la ruta correcta que creamos en el web.php --}}
                        <form action="{{ route('login.execute') }}" method="post">
                            @csrf 
                            
                            {{-- Campo Correo Electrónico --}}
                            <div class="mb-3 text-start">
                                <label for="email" class="form-label fw-semibold text-secondary">Correo Electrónico</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control form-control-custom-field @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="ejemplo@correo.com"
                                    required
                                    autofocus
                                >
                                @error('email')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo Contraseña --}}
                            <div class="mb-4 text-start">
                                <label for="password" class="form-label fw-semibold text-secondary">Contraseña</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control form-control-custom-field @error('password') is-invalid @enderror"
                                    placeholder="••••••••"
                                    required
                                >
                                @error('password')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Botón Iniciar Sesión --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-login py-2.5 shadow-sm d-flex align-items-center justify-content-center">
                                    Iniciar Sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                {{-- Texto de advertencia de usabilidad --}}
                <div class="text-center mt-4 text-muted small login-warning-box">
                    <p class="mb-0">
                        <strong>Acceso Restringido:</strong> Espacio exclusivo para personal de administración y gestión de contenidos.
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-main-layout>