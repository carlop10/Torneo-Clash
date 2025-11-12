<?php
// app/Http/Controllers/PartidoController.php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Jugador;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    // Mostrar todos los enfrentamientos por rondas
    public function enfrentamientos()
    {
        $partidos = Partido::with(['jugador1', 'jugador2', 'ganador'])
                          ->orderBy('ronda')
                          ->orderBy('id')
                          ->get()
                          ->groupBy('ronda');

        $totalPartidos = Partido::count();
        $partidosJugados = Partido::where('estado', 'jugado')->count();
        $progreso = $totalPartidos > 0 ? round(($partidosJugados / $totalPartidos) * 100) : 0;

        return view('enfrentamientos', compact('partidos', 'progreso'));
    }

    // Registrar ganador de un partido
    public function registrarGanador(Request $request, Partido $partido)
    {
        $request->validate([
            'ganador_id' => 'required|exists:jugadores,id'
        ]);

        // Verificar que el ganador es uno de los jugadores del partido
        if (!in_array($request->ganador_id, [$partido->jugador1_id, $partido->jugador2_id])) {
            return back()->with('error', 'El ganador debe ser uno de los jugadores del partido.');
        }

        // Actualizar partido
        $partido->update([
            'ganador_id' => $request->ganador_id,
            'estado' => 'jugado'
        ]);

        // Actualizar estadísticas de jugadores
        $this->actualizarEstadisticasJugadores($partido);

        return back()->with('success', 'Resultado registrado exitosamente!');
    }

    // Reiniciar partido (en caso de error)
    public function reiniciarPartido(Partido $partido)
    {
        // Revertir estadísticas de jugadores
        if ($partido->ganador_id) {
            $perdedor_id = ($partido->jugador1_id == $partido->ganador_id)
                         ? $partido->jugador2_id
                         : $partido->jugador1_id;

            // Restar puntos y partidos jugados
            Jugador::where('id', $partido->ganador_id)->decrement('puntos');
            Jugador::where('id', $partido->ganador_id)->decrement('partidos_jugados');
            Jugador::where('id', $perdedor_id)->decrement('partidos_jugados');
        }

        // Reiniciar partido
        $partido->update([
            'ganador_id' => null,
            'estado' => 'pendiente'
        ]);

        return back()->with('info', 'Partido reiniciado. Puedes registrar un nuevo resultado.');
    }

    private function actualizarEstadisticasJugadores(Partido $partido)
    {
        // Sumar punto al ganador
        Jugador::where('id', $partido->ganador_id)->increment('puntos');

        // Incrementar partidos jugados para ambos
        Jugador::where('id', $partido->jugador1_id)->increment('partidos_jugados');
        Jugador::where('id', $partido->jugador2_id)->increment('partidos_jugados');
    }
}
