<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Libros' }}:: Lista de libros</title>
    
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/style.css') ?>">
</head>
<body class="d-flex flex-column min-vh-100"> <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= url('/') ?>" >A&L BOOKS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link {{ Request()->is('/') ? 'active' : '' }}" {{request ()->is('/') ? 'aria-current="page"' : ''}} href="<?= url('/') ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request()->is('/nosotros') ? 'active' : '' }}" {{request ()->is('/nosotros') ? 'aria-current="page"' : ''}} href="<?= url('/nosotros') ?>">Nosotros</a></li>
                        <li class="nav-item"><a class="nav-link {{ Request()->is('/book/listado') ? 'active' : '' }}" {{request ()->is('/book/listado') ? 'aria-current="page"' : ''}} href="<?= url('/book/listado') ?>">Libros</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container py-4">
            {{ $slot }}
        </main> <footer class="footer mt-auto py-3 bg-light text-center">
            <div class="container">
                <p class="mb-0">&copy; 2026 Tienda de Libros Online. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div> <script src="<?= url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>