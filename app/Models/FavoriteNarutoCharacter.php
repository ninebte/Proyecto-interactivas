<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteNarutoCharacter extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'character_name', 'character_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
