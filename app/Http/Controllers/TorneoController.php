<?php
// app/Http/Controllers/TorneoController.php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Partido;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    // Mostrar tabla de clasificación
    public function clasificacion()
    {
        $jugadores = Jugador::orderBy('puntos', 'DESC')
                           ->orderBy('partidos_jugados', 'ASC')
                           ->get();

        $totalPartidos = Partido::count();
        $partidosJugados = Partido::where('estado', 'jugado')->count();
        $progreso = $totalPartidos > 0 ? round(($partidosJugados / $totalPartidos) * 100) : 0;

        return view('clasificacion', compact('jugadores', 'progreso'));
    }

    // Generar enfrentamientos (round robin)
    public function generarEnfrentamientos()
    {
        // Verificar si ya existen partidos
        if (Partido::count() > 0) {
            return redirect()->route('enfrentamientos')
                           ->with('info', 'Los enfrentamientos ya fueron generados.');
        }

        $jugadores = Jugador::pluck('id')->toArray();
        $numJugadores = count($jugadores);
        $rondas = $numJugadores - 1;

        // Algoritmo round robin
        for ($ronda = 1; $ronda <= $rondas; $ronda++) {
            $emparejamientos = $this->generarEmparejamientos($jugadores, $ronda);

            foreach ($emparejamientos as $emparejamiento) {
                Partido::create([
                    'ronda' => $ronda,
                    'jugador1_id' => $emparejamiento[0],
                    'jugador2_id' => $emparejamiento[1],
                    'estado' => 'pendiente'
                ]);
            }
        }

        return redirect()->route('enfrentamientos')
                       ->with('success', 'Enfrentamientos generados exitosamente!');
    }

    private function generarEmparejamientos($jugadores, $ronda)
    {
        $numJugadores = count($jugadores);
        $emparejamientos = [];

        // Algoritmo simple round robin
        for ($i = 0; $i < $numJugadores / 2; $i++) {
            $jugador1 = $jugadores[$i];
            $jugador2 = $jugadores[$numJugadores - 1 - $i];

            if ($jugador1 != $jugador2) {
                // Alternar localía en rondas pares/impares
                if ($ronda % 2 == 0) {
                    $emparejamientos[] = [$jugador1, $jugador2];
                } else {
                    $emparejamientos[] = [$jugador2, $jugador1];
                }
            }
        }

        // Rotar jugadores para la siguiente ronda
        $ultimo = array_pop($jugadores);
        array_splice($jugadores, 1, 0, $ultimo);

        return $emparejamientos;
    }
}
