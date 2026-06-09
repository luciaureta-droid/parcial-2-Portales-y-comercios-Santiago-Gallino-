<x-main-layout>
    <x-slot:title>
        Sobre Nosotros - A&L BOOKS
    </x-slot:title>

    {{-- BLOQUE 1: HERO (Estructura idéntica a la cabecera de Pinterest) --}}
    <section class="container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <h1 class="display-3 fw-bold text-dark border-0 p-0 m-0 leading-tight">
                    Nuestra <br><span class="text-primary-custom">Historia</span>
                </h1>
                <p class="lead text-secondary my-4 fs-4">
                    <strong>A&L Books</strong> no nació como una simple tienda, sino como un sueño compartido entre <strong>Lucia Ureta y Alex Cruz</strong>: el refugio donde los libros y los lectores se encuentran finalmente.
                </p>
                <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                    <a href="{{ route('books.index') }}" class="btn btn-orange btn-lg px-4 py-3 rounded-pill shadow-sm">Explorar Catálogo</a>
                    <a href="#contacto" class="btn btn-outline-dark btn-lg px-4 py-3 rounded-pill">Vení a Visitarnos</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative hero-img-container">
                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=600&h=450&fit=crop" class="img-fluid rounded-4 shadow-lg hero-mockup" alt="Escritorio A&L Books">
                    <div class="position-absolute bottom-0 start-0 bg-dark text-white p-2 px-3 m-3 rounded-pill small shadow">
                        Desde 2024 creando lectores
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BLOQUE 2: VALORES (Tarjetas alineadas con fondos pastel del ejemplo) --}}
    <section class="bg-white-capsule py-5 my-5">
        <div class="container text-center">
            <h3 class="h6 text-uppercase tracking-wider text-secondary border-0 mb-2 p-0" style="letter-spacing: 2px;">Nuestros Pilares</h3>
            <h2 class="display-6 fw-bold mb-5 text-dark border-0 p-0">Pasión por la Lectura</h2>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 h-100 shadow-sm bg-white hover-zoom">
                        <div class="icon-circle bg-pastel-1 mx-auto mb-3">
                            <i class="bi bi-search"></i>
                        </div>
                        <h4 class="fw-bold text-dark fs-5 mb-2">Curaduría Especializada</h4>
                        <p class="small text-muted mb-0">Seleccionamos cada título con atención al detalle, buscando calidad literaria en cada género disponible.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 h-100 shadow-sm bg-white hover-zoom">
                        <div class="icon-circle bg-pastel-3 mx-auto mb-3">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <h4 class="fw-bold text-dark fs-5 mb-2">Atención con Pasión</h4>
                        <p class="small text-muted mb-0">Amamos lo que hacemos. Nuestro equipo está listo para ofrecerte una recomendación personalizada siempre.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 rounded-4 h-100 shadow-sm bg-white hover-zoom">
                        <div class="icon-circle bg-pastel-5 mx-auto mb-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="fw-bold text-dark fs-5 mb-2">Comunidad Lectora</h4>
                        <p class="small text-muted mb-0">Buscamos ser un club. Organizamos encuentros porque los libros se disfrutan más cuando se comparten.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BLOQUE 3: INFO & UBICACIÓN (Estructura de tildes idéntica a "Why Choose Us") --}}
    <section id="contacto" class="container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="display-6 fw-bold mb-4 text-dark border-0 p-0">Vení a visitarnos</h2>
                <p class="text-secondary mb-4">Estamos ubicados en el corazón de <strong>Bella Vista</strong>. Te invitamos a pasar, tomar un café de cortesía y perderte entre nuestros estantes llenos de magia.</p>
                
                <div class="row g-4">
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle text-orange-icon fs-4 me-3"></i>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Dirección Central</h5>
                                <p class="small text-secondary m-0">Av. Principal 1234, Bella Vista, Buenos Aires.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle text-orange-icon fs-4 me-3"></i>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Horarios de Atención</h5>
                                <p class="small text-secondary m-0">Lunes a Sábados: 09:00 a 20:00 hs (Domingos Cerrado).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle text-orange-icon fs-4 me-3"></i>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Contacto Directo</h5>
                                <p class="small text-secondary m-0">hola@albooks.com.ar | Tel: (011) 4567-8910</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="row g-2">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1529148482759-b35b25c5f217?q=80&w=400&h=500&fit=crop" class="img-fluid rounded-4 shadow-sm" alt="Librería Interior">
                    </div>
                    <div class="col-6 mt-4">
                        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?q=80&w=400&h=500&fit=crop" class="img-fluid rounded-4 shadow-sm" alt="Estanterías">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BLOQUE 4: TESTIMONIO / PROCESO FINITO --}}
    <section class="py-5 my-5 bg-light-step">
        <div class="container text-center py-3">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <i class="bi bi-quote text-orange-icon display-3 opacity-70 d-block mb-2"></i>
                    <blockquote class="blockquote mb-0">
                        <p class="display-6 fst-italic text-dark fw-normal">"Un libro es un regalo que puedes abrir una y otra vez."</p>
                        <footer class="blockquote-footer mt-3 text-muted fs-5"><cite title="Source Title">Garrison Keillor</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    {{-- NAVEGACIÓN INFERIOR INTEGRADA --}}
    <div class="container mb-5">
        <nav class="d-flex justify-content-between align-items-center" aria-label="Navegación de página">
            <a href="{{ url('/') }}" class="btn btn-outline-dark btn-lg rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i> Inicio
            </a>
            <span class="text-muted small fw-bold text-uppercase tracking-wider d-none d-sm-inline">A&L Books</span>
            <a href="{{ route('books.index') }}" class="btn btn-orange btn-lg rounded-pill px-4 shadow-sm">
                Ver Libros <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </nav>
    </div>
</x-main-layout>