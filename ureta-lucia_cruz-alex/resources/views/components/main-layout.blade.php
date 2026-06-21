<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title ?? '' }} :: A&L BIBLIOTECA ONLINE</title>
        
        {{--Bootstrap oficial--}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        {{--CSS--}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div id="app">
            
            {{-- Navbar responsive nativo con Bootstrap --}}
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}"> A&L BIBLIOTECA ONLINE </a>
                    
                    {{-- Botón hamburguesa: visible SOLO en celulares y tablets chicos --}}
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    {{-- Contenedor colapsable inteligente --}}
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav gap-2 ms-auto mt-3 mt-md-0">
                            <li class="nav-item">
                                <x-nav-link to="home">Home</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link to="about">Nosotros</x-nav-link>
                            </li>
                            
                            {{-- Enlace dinámico de Libros: cambia según si estás logueada o no --}}
                            <li class="nav-item">
                                @auth
                                    <x-nav-link to="books.admin">Libros</x-nav-link>
                                @else
                                    <x-nav-link to="books.index">Libros</x-nav-link>
                                @endauth
                            </li>

                            <li class="nav-item">
                                <x-nav-link to="blog.index">Blog de Autores</x-nav-link>
                            </li>
                            <li class="nav-item">
                                <x-nav-link to="contacto">Contacto</x-nav-link>
                            </li>
                            
                            @auth
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="post" class="m-0">
                                    @csrf
                                    <button type="submit" class="nav-link text-white w-100 text-start bg-transparent border-0">{{ auth()->user()->email }} (Cerrar)</button>
                                </form>
                            </li>
                            @else
                            <li class="nav-item">
                                <x-nav-link to="login.show">Ingresar</x-nav-link>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- Contenido principal responsivo --}}
            <main class="container middle-content py-5 text-center">
                @if(session()->has('feedback.message'))
                    <div class="alert alert-{{ session()->get('feedback.type', 'success') }}">{!! session()->get('feedback.message') !!}</div>
                @endif

                {{ $slot }}
            </main>

            {{-- Footer responsivo --}}
            <footer class="footer mt-auto py-3 text-center">
                <p class="mb-0 text-white">URETA & CRUZ &copy; 2026</p>
            </footer>
        </div>

        {{-- El complemento de JavaScript de Bootstrap --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>