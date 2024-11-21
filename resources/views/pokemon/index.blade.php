@extends('layouts.app')

@section('title', 'Búsqueda de Pokémon')

@section('content')
    <h1 class="mt-4">Búsqueda de Pokémon</h1>

    <form action="{{ route('pokemon.search') }}" method="GET" class="mt-3">
        <div class="input-group mb-3">
            <input type="text" name="query" class="form-control" placeholder="Buscar Pokémon por nombre" value="{{ $query ?? '' }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    @if(isset($results) && count($results) > 0)
        <h3 class="mt-4">Resultados:</h3>
        <div class="row">
            @foreach($results as $pokemon)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $pokemon['image'] }}" class="card-img-top" alt="{{ $pokemon['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ ucfirst($pokemon['name']) }}</h5>
                            <p class="card-text"><strong>ID:</strong> {{ $pokemon['id'] }}</p>
                            <p class="card-text"><strong>Altura:</strong> {{ $pokemon['height'] }} dm</p>
                            <p class="card-text"><strong>Peso:</strong> {{ $pokemon['weight'] }} hg</p>
                            <form action="{{ route('pokemon.add_favorite') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="pokemon_name" value="{{ $pokemon['name'] }}">
                                <input type="hidden" name="pokemon_id" value="{{ $pokemon['id'] }}">
                                <input type="hidden" name="pokemon_image" value="{{ $pokemon['image'] }}">
                                <button type="submit" class="btn btn-success">Agregar a Favoritos</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($query))
        <div class="alert alert-warning mt-4">No se encontraron Pokémones para "{{ $query }}".</div>
    @endif
@endsection
