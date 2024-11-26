<!-- resources/views/partials/header.blade.php -->
<style>
    .minimalist-header {
        background: linear-gradient(90deg, #3498db, #2ecc71);
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        color: white;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        color: white;
    }

    .header-user-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-user-greeting {
        margin: 0;
        font-weight: 500;
    }

    .header-logout-link {
        color: white;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 20px;
        transition: background-color 0.3s ease;
    }

    .header-logout-link:hover {
        background-color: rgba(255,255,255,0.2);
    }

    @media (max-width: 768px) {
        .minimalist-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .header-user-section {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<header class="minimalist-header">
    <div>
        <h2 class="header-title">Mi Aplicación</h2>
    </div>
    <div class="header-user-section">
        <p class="header-user-greeting">Hola, {{ $authUser->name ?? 'Usuario' }}</p>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="header-logout-link">
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="hidden">
            @csrf
        </form>
    </div>
</header>