@extends('layouts.app')

@section('title', 'Búsqueda de Pokémon')

@section('content')
<style>
    .pokemon-search-container {
        background: linear-gradient(135deg, #3a53a533, #ffffff66);
        padding: 2rem;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    .search-header {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .search-header h1 {
        color: #2a3f77;
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .search-bar {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 1rem;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .search-input {
        border: none;
        border-radius: 25px;
        padding: 0.8rem 1.5rem;
        font-size: 1.1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        box-shadow: 0 0 0 2px #3a53a5;
    }

    .search-btn {
        background: linear-gradient(135deg, #3a53a5 0%, #2a3f77 100%);
        border: none;
        border-radius: 25px;
        padding: 0.8rem 2rem;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(58, 83, 165, 0.3);
    }

    .results-container {
        margin-top: 3rem;
    }

    .results-header {
        color: #2a3f77;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .pokemon-card {
        background: white;
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .pokemon-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    .pokemon-image-container {
        position: relative;
        padding-top: 100%;
        background: linear-gradient(45deg, #f6f6f6, #ffffff);
        overflow: hidden;
    }

    .pokemon-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 1.5rem;
        transition: transform 0.3s ease;
    }

    .pokemon-card:hover .pokemon-image {
        transform: scale(1.1);
    }

    .pokemon-info {
        padding: 1.5rem;
        text-align: center;
    }

    .pokemon-name {
        color: #2a3f77;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .pokemon-stats {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .stat-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        color: #666;
    }

    .stat-label {
        font-weight: 600;
    }

    .btn-favorite {
        background: linear-gradient(135deg, #43a047 0%, #2e7d32 100%);
        border: none;
        border-radius: 50px;
        color: white;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-favorite:hover {
        background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
        transform: translateY(-2px);
    }

    .no-results {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        margin-top: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .no-results p {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .pokemon-search-container {
            padding: 1rem;
        }

        .search-header h1 {
            font-size: 2rem;
        }

        .search-bar {
            padding: 0.5rem;
        }

        .search-input {
            font-size: 1rem;
        }
    }
</style>

<div class="container">
    <div class="pokemon-search-container">
        <div class="search-header">
            <h1>
                <i class="fas fa-search me-2"></i>
                Búsqueda de Pokémon
            </h1>
        </div>

        <form action="{{ route('pokemon.search') }}" method="GET">
            <div class="search-bar">
                <div class="input-group">
                    <input
                        type="text"
                        name="query"
                        class="form-control search-input"
                        placeholder="¿Qué Pokémon estás buscando?"
                        value="{{ $query ?? '' }}">
                    <button class="btn search-btn" type="submit">
                        <i class="fas fa-search me-2"></i>Buscar
                    </button>
                </div>
            </div>
        </form>

        @if(isset($results) && count($results) > 0)
        <div class="results-container">
            <h3 class="results-header">Pokémon Encontrados</h3>
            <div class="row">
                @foreach($results as $pokemon)
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="pokemon-card">
                        <div class="pokemon-image-container">
                            <img src="{{ $pokemon['image'] }}" class="pokemon-image" alt="{{ $pokemon['name'] }}">
                        </div>
                        <div class="pokemon-info">
                            <h5 class="pokemon-name">{{ ucfirst($pokemon['name']) }}</h5>
                            <div class="pokemon-stats">
                                <div class="stat-item">
                                    <span class="stat-label">Número Pokédex:</span>
                                    <span>#{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Altura:</span>
                                    <span>{{ $pokemon['height'] }} dm</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Peso:</span>
                                    <span>{{ $pokemon['weight'] }} hg</span>
                                </div>
                            </div>
                            <form action="{{ route('pokemon.add_favorite') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pokemon_name" value="{{ $pokemon['name'] }}">
                                <input type="hidden" name="pokemon_id" value="{{ $pokemon['id'] }}">
                                <input type="hidden" name="pokemon_image" value="{{ $pokemon['image'] }}">
                                <button type="submit" class="btn-favorite">
                                    <i class="fas fa-heart me-2"></i>Agregar a Favoritos
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @elseif(isset($query))
        <div class="no-results">
            <p>
                <i class="fas fa-search-minus me-2"></i>
                No se encontraron Pokémon que coincidan con "{{ $query }}"
            </p>
        </div>
        @endif
    </div>
</div>
@endsection