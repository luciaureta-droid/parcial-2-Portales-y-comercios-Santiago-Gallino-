@props(['to'])

<a
    // La clase 'nav-link' es una clase de Bootstrap que se utiliza para estilizar los enlaces de navegación. La clase 'active' se agrega dinámicamente si la ruta actual coincide con la ruta especificada en el atributo 'to'. Esto permite resaltar el enlace activo en la barra de navegación.
    class="nav-link {{ request()->routeIs($to) ? 'active' : '' }}" 
    {{ request()->routeIs($to) ? 'aria-current="page"' : '' }}
    href="{{ route($to) }}"
>
    {{ $slot }}
</a>