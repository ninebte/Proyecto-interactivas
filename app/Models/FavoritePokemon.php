<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritePokemon extends Model
{
    use HasFactory;

    protected $table = 'favorite_pokemons';

    protected $fillable = ['user_id', 'pokemon_name', 'pokemon_id', 'pokemon_image'];

    // Relación con usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
