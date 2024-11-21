@extends('layouts.app')

@section('title', 'Pokémones Favoritos')

@section('content')
    <h1 class="mt-4">Mis Pokémones Favoritos</h1>

    @if ($favorites->isEmpty())
        <p class="mt-3">No tienes Pokémones favoritos aún. <a href="{{ route('pokemon.search') }}">Busca uno aquí</a>.</p>
    @else
        <div class="row mt-4">
            @foreach ($favorites as $favorite)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $favorite->pokemon_image }}" class="card-img-top" alt="{{ $favorite->pokemon_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ ucfirst($favorite->pokemon_name) }}</h5>
                            <p><strong>ID:</strong> {{ $favorite->pokemon_id }}</p>
                            <form action="{{ route('pokemon.remove_favorite', $favorite->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Eliminar de Favoritos</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
