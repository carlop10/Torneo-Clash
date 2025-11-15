<!-- resources/views/inicio.blade.php -->
@extends('layouts.app')

@section('content')
<div class="text-center max-w-4xl mx-auto">
    <!-- Hero Section -->
    <div class="card-clash rounded-2xl p-4 md:p-8 lg:p-12 mb-6 md:mb-8">
        <div class="text-4xl md:text-5xl lg:text-6xl mb-4 md:mb-6">👑</div>
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4 drop-shadow-lg">
            Torneo Clash Royale
        </h1>
        <p class="text-base md:text-lg lg:text-xl text-gray-700 mb-6 md:mb-8 px-2">
            ¡Bienvenido al torneo privado! Sigue los enfrentamientos y la clasificación en tiempo real.
        </p>

        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 lg:space-x-6 px-2">
            <a href="{{ route('enfrentamientos') }}"
               class="btn-royale px-4 py-3 md:px-6 md:py-4 lg:px-8 lg:py-4 rounded-xl text-base md:text-lg font-bold text-white transition transform hover:scale-105 w-full sm:w-auto">
               ⚔️ Ver Enfrentamientos
            </a>
            <a href="{{ route('clasificacion') }}"
               class="bg-purple-600 px-4 py-3 md:px-6 md:py-4 lg:px-8 lg:py-4 rounded-xl text-base md:text-lg font-bold text-white border-2 border-purple-800 transition transform hover:scale-105 hover:bg-purple-700 w-full sm:w-auto">
               📊 Ver Clasificación
            </a>
        </div>
    </div>

    <!-- Jugadores -->
    <div class="card-clash rounded-2xl p-4 md:p-6 lg:p-8">
        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 md:mb-6">👥 Jugadores del Torneo</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
            @php
                $jugadores = ['Jeremy', 'Jairo', 'Carlos', 'Aroca', 'Cristian', 'Zamith', 'Keyn', 'William'];
            @endphp
            @foreach($jugadores as $jugador)
            <div class="bg-white border-2 border-amber-400 rounded-lg p-3 md:p-4 text-center transition transform hover:scale-105">
                <div class="text-xl md:text-2xl mb-1 md:mb-2">🎯</div>
                <div class="font-bold text-gray-800 text-sm md:text-base">{{ $jugador }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
