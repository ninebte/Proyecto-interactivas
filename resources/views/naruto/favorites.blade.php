@extends('layouts.app')

@section('title', 'Mis Personajes Favoritos')

@section('content')
    <h1 class="mt-4">Mis Personajes Favoritos de Naruto</h1>

    @if ($favorites->isEmpty())
        <p>No tienes personajes favoritos aún. <a href="{{ route('naruto.search') }}">Busca uno aquí</a>.</p>
    @else
        <div class="row mt-4">
            @foreach ($favorites as $favorite)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $favorite->character_image }}" class="card-img-top" alt="{{ $favorite->character_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->character_name }}</h5>
                            <form action="{{ route('naruto.remove_favorite', $favorite->id) }}" method="POST">
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
