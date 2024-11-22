@extends('layouts.app')

@section('title', 'Pokémones Favoritos')

@section('content')
<style>
    .pokemon-header {
        background: linear-gradient(135deg, #FF0000 0%, #CC0000 100%);
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(204, 0, 0, 0.2);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .pokemon-header::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 150px;
        height: 150px;
        background: url('/api/placeholder/150/150') no-repeat center/contain;
        opacity: 0.1;
        transform: translate(-50%, -50%);
    }

    .pokemon-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .pokemon-card {
        background: white;
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .pokemon-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .pokemon-card .card-img-container {
        position: relative;
        padding-top: 100%;
        background: linear-gradient(45deg, #f6f6f6, #ffffff);
        overflow: hidden;
    }

    .pokemon-card .card-img-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 1rem;
        transition: transform 0.3s ease;
    }

    .pokemon-card:hover .card-img-top {
        transform: scale(1.1);
    }

    .pokemon-card .card-body {
        padding: 1.5rem;
        text-align: center;
    }

    .pokemon-card .card-title {
        color: #333;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .pokemon-id {
        background: #f8f9fa;
        border-radius: 50px;
        padding: 0.3rem 1rem;
        display: inline-block;
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .btn-remove {
        background: linear-gradient(135deg, #ff4b4b 0%, #cc0000 100%);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }

    .btn-remove:hover {
        background: linear-gradient(135deg, #cc0000 0%, #990000 100%);
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .empty-state p {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 1.5rem;
    }

    .btn-search {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, #2980b9 0%, #206592 100%);
        transform: translateY(-2px);
        color: white;
    }

    @media (max-width: 768px) {
        .pokemon-header {
            padding: 1.5rem;
        }

        .pokemon-header h1 {
            font-size: 2rem;
        }

        .pokemon-card {
            margin-bottom: 2rem;
        }
    }
</style>

<div class="container">
    <div class="pokemon-header">
        <h1>Mis Pokémones Favoritos</h1>
    </div>

    @if ($favorites->isEmpty())
    <div class="empty-state">
        <p>¡Aún no has capturado ningún Pokémon favorito!</p>
        <a href="{{ route('pokemon.search') }}" class="btn-search">
            <i class="fas fa-search me-2"></i>Explorar Pokémon
        </a>
    </div>
    @else
    <div class="row">
        @foreach ($favorites as $favorite)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="pokemon-card">
                <div class="card-img-container">
                    <img src="{{ $favorite->pokemon_image }}" class="card-img-top" alt="{{ $favorite->pokemon_name }}">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ ucfirst($favorite->pokemon_name) }}</h5>
                    <div class="pokemon-id">
                        #{{ str_pad($favorite->pokemon_id, 3, '0', STR_PAD_LEFT) }}
                    </div>
                    <form action="{{ route('pokemon.remove_favorite', $favorite->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-remove">
                            <i class="fas fa-heart-broken me-2"></i>Liberar Pokémon
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection