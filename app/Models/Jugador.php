<?php
// app/Models/Jugador.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores';

    protected $fillable = ['nombre', 'puntos', 'partidos_jugados'];

    protected $casts = [
        'puntos' => 'integer',
        'partidos_jugados' => 'integer',
    ];

    // Relación: partidos como jugador 1
    public function partidosComoJugador1()
    {
        return $this->hasMany(Partido::class, 'jugador1_id');
    }

    // Relación: partidos como jugador 2
    public function partidosComoJugador2()
    {
        return $this->hasMany(Partido::class, 'jugador2_id');
    }

    // Todos los partidos del jugador
    public function partidos()
    {
        return $this->partidosComoJugador1->merge($this->partidosComoJugador2);
    }
}
