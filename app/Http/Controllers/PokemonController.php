<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FavoritePokemon;

class PokemonController extends Controller
{
    // Método para buscar Pokémones por nombre
    public function search(Request $request)
    {
        $query = $request->input('query'); // Obtener el término de búsqueda
        $results = [];

        if ($query) {
            // Obtener la lista completa de Pokémones
            $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit=10000");

            if ($response->successful()) {
                $allPokemon = $response->json()['results'];

                // Filtrar Pokémones que coincidan parcialmente con el término de búsqueda
                $filteredPokemon = collect($allPokemon)->filter(function ($pokemon) use ($query) {
                    return stripos($pokemon['name'], $query) !== false; // Coincidencia parcial
                })->values();

                // Obtener información detallada de cada Pokémon filtrado
                $results = $filteredPokemon->map(function ($pokemon) {
                    $detailsResponse = Http::get($pokemon['url']);
                    if ($detailsResponse->successful()) {
                        $details = $detailsResponse->json();
                        return [
                            'name' => $details['name'],
                            'id' => $details['id'],
                            'weight' => $details['weight'],
                            'height' => $details['height'],
                            'image' => $details['sprites']['front_default'],
                        ];
                    }
                    return null;
                })->filter(); // Eliminar resultados nulos en caso de errores
            }
        }

        return view('pokemon.index', compact('results', 'query'));
    }

    public function addFavorite(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar favoritos.');
        }
    
        $userId = session('user_id');
    
        // Verificar si el Pokémon ya está en favoritos
        $exists = FavoritePokemon::where('user_id', $userId)
            ->where('pokemon_id', $request->pokemon_id)
            ->exists();
    
        if ($exists) {
            return redirect()->route('pokemon.search')->with('error', 'Este Pokémon ya está en tus favoritos.');
        }
    
        // Guardar en favoritos
        FavoritePokemon::create([
            'user_id' => $userId,
            'pokemon_name' => $request->pokemon_name,
            'pokemon_id' => $request->pokemon_id,
            'pokemon_image' => $request->pokemon_image, // Guardar URL de la imagen
        ]);
    
        return redirect()->route('pokemon.search')->with('success', '¡Pokémon agregado a tus favoritos!');
    }
    

public function favorites()
{
    if (!session()->has('user_id')) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus favoritos.');
    }

    $userId = session('user_id');
    $favorites = FavoritePokemon::where('user_id', $userId)->get();

    return view('pokemon.favorites', compact('favorites'));
}

public function removeFavorite($id)
{
    if (!session()->has('user_id')) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
    }

    $userId = session('user_id');
    $favorite = FavoritePokemon::where('id', $id)->where('user_id', $userId)->first();

    if (!$favorite) {
        return redirect()->route('pokemon.favorites')->with('error', 'Pokémon no encontrado en tus favoritos.');
    }

    $favorite->delete();

    return redirect()->route('pokemon.favorites')->with('success', 'Pokémon eliminado de tus favoritos.');
}

}
