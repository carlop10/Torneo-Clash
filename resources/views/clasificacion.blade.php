<!-- resources/views/clasificacion.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-2 sm:px-4">
        <h2 class="text-2xl sm:text-3xl font-bold text-white text-center mb-4 sm:mb-6 md:mb-8 drop-shadow-lg">
            🏆 Tabla de Clasificación
        </h2>

        <!-- resources/views/clasificacion.blade.php -->
        <div class="card-clash rounded-xl p-2 sm:p-4 md:p-6 mb-6 md:mb-8">
            <div class="overflow-x-auto -mx-1 sm:mx-0">
                <table class="w-full min-w-[100px] sm:min-w-0"> <!-- ← Ancho mínimo reducido -->
                    <thead>
                        <tr class="bg-amber-600 text-gray-900">
                            <th class="px-2 py-2 text-left font-bold text-xs sm:text-sm w-2">Pos</th> <!-- 48px -->
                            <th class="px-2 py-2 text-left font-bold text-xs sm:text-sm w-2 sm:w-32">Jugador</th>
                            <!-- 96px → 128px -->
                            <th class="px-2 py-2 text-center font-bold text-xs sm:text-sm w-2">Pts</th> <!-- 48px -->
                            <th class="px-2 py-2 text-center font-bold text-xs sm:text-sm w-2 hidden sm:table-cell">PJ</th>
                            <!-- 48px -->
                            <th class="px-2 py-2 text-center font-bold text-xs sm:text-sm w-2 hidden md:table-cell">Efec%
                            </th> <!-- 80px -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jugadores as $index => $jugador)
                            <tr class="border-b border-amber-200 transition hover:bg-amber-100">
                                <td class="px-2 py-2 font-bold text-gray-800 text-xs sm:text-sm">
                                    @switch($index + 1)
                                        @case(1)
                                            🥇
                                        @break

                                        @case(2)
                                            🥈
                                        @break

                                        @case(3)
                                            🥉
                                        @break

                                        @default
                                            #{{ $index + 1 }}
                                    @endswitch
                                </td>
                                <td class="px-2 py-2 font-bold text-gray-800 text-xs sm:text-sm truncate">
                                    👑 {{ $jugador->nombre }}
                                </td>
                                <td class="px-2 py-2 text-center font-bold text-green-600 text-xs sm:text-sm">
                                    {{ $jugador->puntos }}
                                </td>
                                <td class="px-2 py-2 text-center text-gray-700 text-xs sm:text-sm hidden sm:table-cell">
                                    {{ $jugador->partidos_jugados }}
                                </td>
                                <td class="px-2 py-2 text-center hidden md:table-cell">
                                    @php
                                        $efectividad =
                                            $jugador->partidos_jugados > 0
                                                ? round(($jugador->puntos / $jugador->partidos_jugados) * 100)
                                                : 0;
                                    @endphp
                                    <div class="flex items-center justify-center space-x-1">
                                        <div class="w-10 bg-gray-300 rounded-full h-1.5">
                                            <div class="bg-green-500 h-1.5 rounded-full"
                                                style="width: {{ $efectividad }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold text-gray-700">{{ $efectividad }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Estadísticas rápidas - Compactas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-4 md:gap-6">
            <div class="card-clash rounded-xl p-3 sm:p-5 md:p-6 text-center">
                <div class="text-xl sm:text-2xl md:text-3xl font-bold text-green-600 mb-1">
                    {{ $jugadores->max('puntos') }}
                </div>
                <div class="text-gray-700 font-bold text-xs sm:text-sm md:text-base">Máx. Puntos</div>
            </div>

            <div class="card-clash rounded-xl p-3 sm:p-5 md:p-6 text-center">
                <div class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-600 mb-1">
                    {{ floor($jugadores->sum('partidos_jugados') / 2) }}
                </div>
                <div class="text-gray-700 font-bold text-xs sm:text-sm md:text-base">Partidos</div>
            </div>

            <div class="card-clash rounded-xl p-3 sm:p-5 md:p-6 text-center">
                <div class="text-xl sm:text-2xl md:text-3xl font-bold text-purple-600 mb-1">
                    {{ $progreso }}%
                </div>
                <div class="text-gray-700 font-bold text-xs sm:text-sm md:text-base">Progreso</div>
            </div>
        </div>

        <!-- Información para móviles -->
        <div class="mt-3 text-center text-white text-xs sm:text-sm md:hidden">
            <p>💡 Desliza para ver más datos</p>
        </div>
    </div>
@endsection
