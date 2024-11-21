@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar Personajes de Naruto</h1>
    
    <form action="{{ route('naruto.fetch') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Ingresa el nombre del personaje" value="{{ request('name') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
    

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!empty($characters))
        <div class="row">
            @foreach($characters as $character)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if(isset($character['images'][0]))
                            <img src="{{ $character['images'][0] }}" class="card-img-top" alt="{{ $character['name'] }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $character['name'] }}</h5>
                            <p class="card-text">
                                @if(isset($character['personal']['species']))
                                    <strong>Especie:</strong> {{ $character['personal']['species'] }}<br>
                                @endif
                            </p>
                            <form action="{{ route('naruto.favorite') }}" method="POST">
                                @csrf
                                <input type="hidden" name="character_name" value="{{ $character['name'] }}">
                                <input type="hidden" name="image_url" value="{{ $character['images'][0] ?? '' }}">
                                <button type="submit" class="btn btn-success">Agregar a Favoritos</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No se encontraron personajes. Intenta buscar algo diferente.</p>
    @endif
</div>
@endsection
