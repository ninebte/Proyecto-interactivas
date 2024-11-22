@extends('layouts.app')

@section('content')
<style>
    :root {
        --naruto-orange: #FF7E1C;
        --naruto-blue: #00A5EA;
        --naruto-red: #ED3B3B;
        --naruto-black: #2C2C2C;
        --scroll-bg: #F4D03F;
    }

    .naruto-container {
        background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)),
            url('/path-to-your-naruto-bg.jpg') center/cover;
        padding: 2rem;
        min-height: 100vh;
    }

    .naruto-title {
        font-family: 'Ninja Naruto', sans-serif;
        color: var(--naruto-black);
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .search-scroll {
        background-color: var(--scroll-bg);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .search-input {
        border: 2px solid var(--naruto-orange);
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        box-shadow: 0 0 0 3px rgba(255, 126, 28, 0.3);
        border-color: var(--naruto-orange);
        outline: none;
    }

    .search-btn {
        background-color: var(--naruto-orange);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background-color: #e06500;
        transform: translateY(-2px);
    }

    .character-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .character-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .character-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-bottom: 3px solid var(--naruto-orange);
    }

    .character-info {
        padding: 1.5rem;
    }

    .character-name {
        color: var(--naruto-black);
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .favorite-btn {
        background-color: var(--naruto-blue);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        width: 100%;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .favorite-btn:hover {
        background-color: #0085bd;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 15px;
        padding: 1rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .naruto-title {
            font-size: 2rem;
        }

        .character-card {
            margin-bottom: 1.5rem;
        }

        .search-scroll {
            padding: 1rem;
        }

        .character-img {
            height: 250px;
        }
    }
</style>

<div class="naruto-container">
    <h1 class="naruto-title">Buscar Personajes de Naruto</h1>

    <div class="search-scroll">
        <form action="{{ route('naruto.fetch') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text"
                    name="name"
                    class="form-control search-input"
                    placeholder="Ingresa el nombre del personaje"
                    value="{{ request('name') }}">
                <div class="input-group-append">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!empty($characters))
    <div class="row">
        @foreach($characters as $character)
        <div class="col-md-6 col-lg-4">
            <div class="character-card">
                @if(isset($character['images'][0]))
                <img src="{{ $character['images'][0] }}"
                    class="character-img"
                    alt="{{ $character['name'] }}">
                @endif
                <div class="character-info">
                    <h5 class="character-name">{{ $character['name'] }}</h5>
                    <p class="character-details">
                        @if(isset($character['personal']['species']))
                        <strong>Especie:</strong> {{ $character['personal']['species'] }}<br>
                        @endif
                    </p>
                    <form action="{{ route('naruto.favorite') }}" method="POST">
                        @csrf
                        <input type="hidden" name="character_name" value="{{ $character['name'] }}">
                        <input type="hidden" name="image_url" value="{{ $character['images'][0] ?? '' }}">
                        <button type="submit" class="favorite-btn">
                            <i class="fas fa-heart"></i> Agregar a Favoritos
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info">
        No se encontraron personajes. Intenta buscar algo diferente.
    </div>
    @endif
</div>
@endsection