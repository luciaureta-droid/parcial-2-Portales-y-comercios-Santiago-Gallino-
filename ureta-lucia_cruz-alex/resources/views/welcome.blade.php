<x-main-layout>
    <x-slot:title>Inicio - A&L Books</x-slot:title>

    {{-- SECTION 1: HERO --}}
    <section class="hero-section container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <h1 class="display-3 fw-bold text-dark border-0 p-0 m-0 leading-tight">
                    Tu Librería <br><span class="text-primary-custom">Online Favorita</span>
                </h1>
                <p class="lead text-secondary my-4 fs-4">
                    Descubrí una curaduría exclusiva de novelas, clásicos y lanzamientos editoriales a precios increíbles con envíos a todo el país.
                </p>
                <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                    <a href="{{ url('/libros/listado') }}" class="btn btn-orange-pinterest px-4 py-3 shadow-sm">Explorar Libros</a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-dark-pinterest px-4 py-3">Sobre Nosotros</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative hero-img-container">
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=600&h=500&fit=crop" class="img-fluid hero-mockup" alt="Mockup de Libros A&L">
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: CATEGORÍAS (Estilo cápsulas Pinterest) --}}
    <section class="bg-white-capsule py-5 my-5">
        <div class="container text-center">
            <span class="text-uppercase tracking-wider text-orange small fw-bold">Categorías Destacadas</span>
            <h2 class="display-6 fw-bold mb-5 text-dark-blue mt-1">¿Qué estás buscando leer hoy?</h2>
            
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card h-100">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <h3 class="fw-bold text-dark-blue fs-6 mb-2">Novelas</h3>
                        <p class="small text-muted mb-0">Ficción y romance.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card h-100">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="bi bi-journal-bookmark-fill"></i>
                        </div>
                        <h3 class="fw-bold text-dark-blue fs-6 mb-2">Ensayos</h3>
                        <p class="small text-muted mb-0">Historia y filosofía.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card h-100">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h3 class="fw-bold text-dark-blue fs-6 mb-2">Poesía</h3>
                        <p class="small text-muted mb-0">Antologías selectas.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card h-100">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="bi bi-brightness-high-fill"></i>
                        </div>
                        <h3 class="fw-bold text-dark-blue fs-6 mb-2">Manga</h3>
                        <p class="small text-muted mb-0">Arte gráfico premium.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card h-100">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h3 class="fw-bold text-dark-blue fs-6 mb-2">Académicos</h3>
                        <p class="small text-muted mb-0">Textos de estudio.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="feature-card h-100">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h3 class="fw-bold text-dark-blue fs-6 mb-2">Novedades</h3>
                        <p class="small text-muted mb-0">Los más vendidos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 3: WHY CHOOSE US --}}
    <section class="container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="display-6 fw-bold mb-4 text-dark-blue border-0 p-0">¿Por qué elegir A&L Books?</h2>
                
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-2 mt-1"></i>
                            <div>
                                <h4 class="fw-bold text-dark-blue h6 mb-1">Envíos Rápidos</h4>
                                <p class="small text-secondary">Recibí tus libros en 24/48 horas hábiles.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-2 mt-1"></i>
                            <div>
                                <h4 class="fw-bold text-dark-blue h6 mb-1">Garantía Total</h4>
                                <p class="small text-secondary">¿Vino fallado? Te lo cambiamos sin cargo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-2 mt-1"></i>
                            <div>
                                <h4 class="fw-bold text-dark-blue h6 mb-1">Precios Justos</h4>
                                <p class="small text-secondary">Descuentos directos de editoriales.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-2 mt-1"></i>
                            <div>
                                <h4 class="fw-bold text-dark-blue h6 mb-1">Atención Real</h4>
                                <p class="small text-secondary">Te asesoramos por WhatsApp de verdad.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=500&h=400&fit=crop" class="img-fluid rounded-4 shadow-sm" alt="Taza de café y libro abierto">
            </div>
        </div>
    </section>

    {{-- SECTION 4: HOW IT WORKS --}}
    <section class="bg-light-step py-5 my-5">
        <div class="container text-center">
            <h2 class="display-6 fw-bold mb-5 text-dark-blue border-0 p-0">¿Cómo comprar tu próximo libro?</h2>
            
            <div class="row g-4 position-relative">
                <div class="col-md-3 step-item">
                    <div class="step-number mx-auto mb-3">1</div>
                    <h3 class="fw-bold text-dark-blue h6">Elegí tu título</h3>
                    <p class="small text-secondary px-3">Navegá por nuestro catálogo y seleccioná tus preferidos.</p>
                </div>
                <div class="col-md-3 step-item">
                    <div class="step-number mx-auto mb-3 step-even">2</div>
                    <h3 class="fw-bold text-dark-blue h6">Cargá tus datos</h3>
                    <p class="small text-secondary px-3">Completá el formulario de envío rápido y seguro.</p>
                </div>
                <div class="col-md-3 step-item">
                    <div class="step-number mx-auto mb-3">3</div>
                    <h3 class="fw-bold text-dark-blue h6">Hacé el pago</h3>
                    <p class="small text-secondary px-3">Aceptamos tarjetas, Mercado Pago y transferencias.</p>
                </div>
                <div class="col-md-3 step-item">
                    <div class="step-number mx-auto mb-3 step-even">4</div>
                    <h3 class="fw-bold text-dark-blue h6">¡A disfrutar!</h3>
                    <p class="small text-secondary px-3">Recibilo en la puerta de tu casa listo para disfrutar.</p>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>