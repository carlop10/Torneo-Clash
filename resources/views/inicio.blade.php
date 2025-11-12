<!-- resources/views/inicio.blade.php -->
@extends('layouts.app')

@section('content')
<div class="text-center max-w-4xl mx-auto">
    <!-- Hero Section -->
    <div class="card-clash rounded-2xl p-12 mb-8">
        <div class="text-6xl mb-6">👑</div>
        <h1 class="text-5xl font-bold text-gray-900 mb-4 drop-shadow-lg">
            Torneo Clash Royale
        </h1>
        <p class="text-xl text-gray-700 mb-8">
            ¡Bienvenido al torneo privado! Sigue los enfrentamientos y la clasificación en tiempo real.
        </p>

        <div class="flex justify-center space-x-6">
            <a href="{{ route('enfrentamientos') }}"
               class="btn-royale px-8 py-4 rounded-xl text-lg font-bold text-white transition transform hover:scale-110">
               ⚔️ Ver Enfrentamientos
            </a>
            <a href="{{ route('clasificacion') }}"
               class="bg-purple-600 px-8 py-4 rounded-xl text-lg font-bold text-white border-2 border-purple-800 transition transform hover:scale-110 hover:bg-purple-700">
               📊 Ver Clasificación
            </a>
        </div>
    </div>

    <!-- Jugadores -->
    <div class="card-clash rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">👥 Jugadores del Torneo</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $jugadores = ['Jeremy', 'Jairo', 'Carlos', 'Aroca', 'Cristian', 'Zamith', 'Keyn', 'Jugador_8'];
            @endphp
            @foreach($jugadores as $jugador)
            <div class="bg-white border-2 border-amber-400 rounded-lg p-4 text-center transition hover:scale-105">
                <div class="text-2xl mb-2">🎯</div>
                <div class="font-bold text-gray-800">{{ $jugador }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
