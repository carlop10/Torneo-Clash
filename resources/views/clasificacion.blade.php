<!-- resources/views/clasificacion.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-white text-center mb-8 drop-shadow-lg">
        🏆 Tabla de Clasificación
    </h2>

    <div class="card-clash rounded-xl p-6 mb-8">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-amber-600 text-gray-900">
                        <th class="px-6 py-4 text-left font-bold">Posición</th>
                        <th class="px-6 py-4 text-left font-bold">Jugador</th>
                        <th class="px-6 py-4 text-center font-bold">Puntos</th>
                        <th class="px-6 py-4 text-center font-bold">Partidos Jugados</th>
                        <th class="px-6 py-4 text-center font-bold">Rendimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jugadores as $index => $jugador)
                    <tr class="border-b border-amber-200 transition hover:bg-amber-100">
                        <td class="px-6 py-4 font-bold text-gray-800">
                            @switch($index + 1)
                                @case(1) 🥇 @break
                                @case(2) 🥈 @break
                                @case(3) 🥉 @break
                                @default #{{ $index + 1 }}
                            @endswitch
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-800">
                            👑 {{ $jugador->nombre }}
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-green-600">
                            {{ $jugador->puntos }} pts
                        </td>
                        <td class="px-6 py-4 text-center text-gray-700">
                            {{ $jugador->partidos_jugados }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $efectividad = $jugador->partidos_jugados > 0 ?
                                    round(($jugador->puntos / $jugador->partidos_jugados) * 100) : 0;
                            @endphp
                            <div class="inline-flex items-center space-x-2">
                                <div class="w-20 bg-gray-300 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full"
                                         style="width: {{ $efectividad }}%"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-700">{{ $efectividad }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-clash rounded-xl p-6 text-center">
            <div class="text-3xl font-bold text-green-600 mb-2">
                {{ $jugadores->max('puntos') }}
            </div>
            <div class="text-gray-700 font-bold">Máximo de Puntos</div>
        </div>

        <div class="card-clash rounded-xl p-6 text-center">
            <div class="text-3xl font-bold text-blue-600 mb-2">
                {{ $jugadores->sum('partidos_jugados') / 2 }}
            </div>
            <div class="text-gray-700 font-bold">Partidos Totales</div>
        </div>

        <div class="card-clash rounded-xl p-6 text-center">
            <div class="text-3xl font-bold text-purple-600 mb-2">
                {{ $progreso }}%
            </div>
            <div class="text-gray-700 font-bold">Progreso del Torneo</div>
        </div>
    </div>
</div>
@endsection
