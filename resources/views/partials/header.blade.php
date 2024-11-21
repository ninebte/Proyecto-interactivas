<!-- resources/views/partials/header.blade.php -->
<header class="bg-gray-100 p-4 flex justify-between items-center border-b border-gray-300">
    <div>
        <h2 class="m-0">Mi Aplicación</h2>
    </div>
    <div class="flex items-center gap-2">
        <p class="m-0">Hola, {{ $authUser->name ?? 'Usuario' }}</p>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="text-blue-500 no-underline font-bold">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="hidden">
            @csrf
        </form>
    </div>
</header>
