@extends('layouts.app')

@section('title', 'Mis Personajes Favoritos')

@section('content')
<style>
    :root {
        --naruto-orange: #FF7B00;
        --naruto-black: #2C2C2C;
        --leaf-green: #4CAF50;
        --scroll-beige: #F4E4BC;
    }

    .naruto-container {
        background: url('/api/placeholder/1920/1080') center/cover fixed;
        padding: 2rem;
        position: relative;
        min-height: 100vh;
    }

    .naruto-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 123, 0, 0.95), rgba(44, 44, 44, 0.90));
        z-index: 1;
    }

    .content-wrapper {
        position: relative;
        z-index: 2;
    }

    .ninja-header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .ninja-header h1 {
        color: var(--scroll-beige);
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin: 0;
        position: relative;
        display: inline-block;
    }

    .ninja-header h1::before,
    .ninja-header h1::after {
        content: '忍';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        color: var(--naruto-orange);
        opacity: 0.6;
    }

    .ninja-header h1::before {
        left: -3rem;
    }

    .ninja-header h1::after {
        right: -3rem;
    }

    .character-card {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .character-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--naruto-orange), var(--leaf-green));
    }

    .character-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(255, 123, 0, 0.3);
    }

    .character-image-container {
        position: relative;
        padding-top: 130%;
        background: linear-gradient(45deg, #f6f6f6, #ffffff);
        overflow: hidden;
    }

    .character-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .character-card:hover .character-image {
        transform: scale(1.1);
    }

    .character-info {
        padding: 1.5rem;
        background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.05));
        text-align: center;
    }

    .character-name {
        color: var(--naruto-black);
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-remove {
        background: linear-gradient(135deg, #ff4b4b 0%, #cc0000 100%);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .btn-remove::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .btn-remove:hover::before {
        left: 100%;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        margin: 2rem auto;
        max-width: 600px;
    }

    .empty-state p {
        color: var(--naruto-black);
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .btn-search {
        background: linear-gradient(135deg, var(--naruto-orange) 0%, #FF4500 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 1rem 2rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 123, 0, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .naruto-container {
            padding: 1rem;
        }

        .ninja-header {
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .ninja-header h1 {
            font-size: 2rem;
        }

        .ninja-header h1::before,
        .ninja-header h1::after {
            display: none;
        }

        .character-card {
            margin-bottom: 2rem;
        }
    }
</style>

<div class="naruto-container">
    <div class="content-wrapper">
        <div class="ninja-header">
            <h1>Mis Ninjas Favoritos</h1>
        </div>

        @if ($favorites->isEmpty())
        <div class="empty-state">
            <p>¡Aún no has agregado ninjas a tu lista! Comienza tu aventura ninja ahora.</p>
            <a href="{{ route('naruto.search') }}" class="btn-search">
                <i class="fas fa-search me-2"></i>Buscar Ninjas
            </a>
        </div>
        @else
        <div class="row">
            @foreach ($favorites as $favorite)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="character-card">
                    <div class="character-image-container">
                        <img src="{{ $favorite->character_image }}"
                            class="character-image"
                            alt="{{ $favorite->character_name }}">
                    </div>
                    <div class="character-info">
                        <h5 class="character-name">{{ $favorite->character_name }}</h5>
                        <form action="{{ route('naruto.remove_favorite', $favorite->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-remove">
                                <i class="fas fa-trash-alt me-2"></i>Eliminar de Favoritos
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection