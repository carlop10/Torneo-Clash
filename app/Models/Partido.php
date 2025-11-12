<?php
// app/Models/Partido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $fillable = [
        'ronda',
        'jugador1_id',
        'jugador2_id',
        'ganador_id',
        'estado'
    ];

    protected $attributes = [
        'estado' => 'pendiente',
    ];

    // Relación con jugador 1
    public function jugador1()
    {
        return $this->belongsTo(Jugador::class, 'jugador1_id');
    }

    // Relación con jugador 2
    public function jugador2()
    {
        return $this->belongsTo(Jugador::class, 'jugador2_id');
    }

    // Relación con ganador
    public function ganador()
    {
        return $this->belongsTo(Jugador::class, 'ganador_id');
    }

    // Scope para partidos pendientes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    // Scope para partidos jugados
    public function scopeJugados($query)
    {
        return $query->where('estado', 'jugado');
    }
}
