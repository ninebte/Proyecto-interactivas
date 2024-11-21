<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FavoriteNarutoCharacter;
use GuzzleHttp\Client;

class NarutoController extends Controller
{
    public function search()
    {
        return view('naruto.search');
    }

    public function fetchCharacters(Request $request)
    {
        $name = $request->input('name');
        $url = "https://narutodb.xyz/api/character";
        
        if ($name) {
            $url .= "/search?name=" . urlencode($name);
        }
    
        $client = new Client();
    
        try {
            $response = $client->get($url, [
                'headers' => ['Accept' => 'application/json'],
            ]);
    
            $data = json_decode($response->getBody(), true);
    
            $characters = isset($data['characters']) ? $data['characters'] : (isset($data) ? [$data] : []);
    
            return view('naruto.search', compact('characters'));
    
        } catch (\Exception $e) {
            return back()->with('error', 'Error al buscar personajes: ' . $e->getMessage());
        }
    }
    

    public function addFavorite(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para guardar favoritos.');
        }

        $userId = session('user_id');

        FavoriteNarutoCharacter::create([
            'user_id' => $userId,
            'character_name' => $request->character_name,
            'character_image' => $request->image_url,
        ]);

        return redirect()->route('naruto.search')->with('success', '¡Personaje agregado a tus favoritos!');
    }

    public function favorites()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus favoritos.');
        }

        $userId = session('user_id');
        $favorites = FavoriteNarutoCharacter::where('user_id', $userId)->get();

        return view('naruto.favorites', compact('favorites'));
    }

    public function removeFavorite($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }

        $userId = session('user_id');
        $favorite = FavoriteNarutoCharacter::where('id', $id)->where('user_id', $userId)->first();

        if (!$favorite) {
            return redirect()->route('naruto.favorites')->with('error', 'Personaje no encontrado en tus favoritos.');
        }

        $favorite->delete();

        return redirect()->route('naruto.favorites')->with('success', 'Personaje eliminado de tus favoritos.');
    }
}
