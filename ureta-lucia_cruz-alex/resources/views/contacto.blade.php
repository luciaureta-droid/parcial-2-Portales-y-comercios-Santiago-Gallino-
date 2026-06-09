<x-main-layout>
    <x-slot:title>Contacto - A&L BOOKS</x-slot:title>

    <div class="container contact-container text-start">
        <div class="contact-bg">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card glass-card shadow-lg p-4 p-md-5 border-0">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold" style="color: var(--primario);">Contactanos</h2>
                                <p class="text-muted">¿Tenés alguna duda o buscás un libro específico? <br> Escribinos y Lucia o Alex te responderemos.</p>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success border-0 shadow-sm mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ url('/contacto') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Nombre Completo</label>
                                        <input type="text" name="nombre" class="form-control rounded-3" placeholder="Tu nombre..." required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Correo Electrónico</label>
                                        <input type="email" name="email" class="form-control rounded-3" placeholder="nombre@ejemplo.com" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Mensaje</label>
                                    <textarea name="mensaje" class="form-control rounded-3" rows="4" placeholder="¿En qué podemos ayudarte?" required></textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg shadow-sm rounded-pill py-3">
                                        Enviar Mensaje
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>