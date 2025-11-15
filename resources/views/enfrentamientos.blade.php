<!-- resources/views/enfrentamientos.blade.php -->
@extends('layouts.app')

@section('content')
<div x-data="{
    activeTab: 'ronda1',
    esAdmin: {{ session('es_admin') ? 'true' : 'false' }},
    mostrarModal: false,
    codigo: '',
    verificarCodigo() {
        if (this.codigo === '%p4sS;w0rd') { // Cambia este código
            this.esAdmin = true;
            this.mostrarModal = false;
            this.codigo = '';
            sessionStorage.setItem('esAdmin', 'true');
        } else {
            alert('Código incorrecto');
            this.codigo = '';
        }
    }
}" x-init="if(sessionStorage.getItem('esAdmin') === 'true') { esAdmin = true; }">



    <!-- Modal para código secreto -->
    <div x-show="mostrarModal"
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="card-clash rounded-2xl p-6 w-full max-w-md mx-auto">
        <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">🔐 Código Admin</h2>
        <p class="text-gray-700 mb-4 text-sm md:text-base">
            Ingresa el código secreto para registrar resultados:
        </p>

        <input type="password"
               x-model="codigo"
               @keyup.enter="verificarCodigo()"
               placeholder="Ingresa el código..."
               class="w-full px-4 py-3 border-2 border-amber-500 rounded-lg mb-4 focus:outline-none focus:border-amber-700 text-sm md:text-base">

        <div class="flex space-x-3">
            <button @click="verificarCodigo()"
                    class="btn-royale flex-1 py-3 rounded-lg font-bold text-white text-sm md:text-base">
                Verificar
            </button>
            <button @click="mostrarModal = false; codigo = ''"
                    class="bg-gray-500 text-white flex-1 py-3 rounded-lg font-bold hover:bg-gray-600 text-sm md:text-base">
                Cancelar
            </button>
        </div>
    </div>
</div>

    <!-- Indicador de modo admin -->
    <div x-show="esAdmin" class="text-center mb-6">
        <div class="bg-red-600 text-white inline-flex items-center space-x-2 px-4 py-2 rounded-full font-bold">
            <span>🔧 MODO ADMIN ACTIVADO</span>
            <button @click="esAdmin = false; sessionStorage.removeItem('esAdmin');"
                    class="bg-red-800 px-2 py-1 rounded text-sm hover:bg-red-900">
                🚪 Salir
            </button>
        </div>
    </div>

    <!-- Botón generar enfrentamientos -->
    @if($partidos->isEmpty())
    <div class="text-center mb-8">
        <template x-if="esAdmin">
            <form action="{{ route('generar.enfrentamientos') }}" method="POST">
                @csrf
                <button type="submit"
                        class="btn-royale px-8 py-4 rounded-xl text-xl font-bold text-white transition transform hover:scale-110">
                    🎮 Generar Enfrentamientos del Torneo
                </button>
            </form>
        </template>
        <div x-show="!esAdmin" class="text-white text-lg">
            ⏳ Esperando que el administrador genere los enfrentamientos...
        </div>
    </div>
    @endif

    <!-- Tabs de rondas -->
    @if(!$partidos->isEmpty())
    <div class="mb-6">
        <div class="flex space-x-2 overflow-x-auto pb-2">
            @foreach($partidos as $ronda => $partidosRonda)
            <button @click="activeTab = 'ronda{{ $ronda }}'"
                    :class="activeTab === 'ronda{{ $ronda }}' ?
                           'bg-yellow-500 text-gray-900 border-2 border-amber-700' :
                           'bg-gray-700 text-white border-2 border-gray-600'"
                    class="px-6 py-3 rounded-lg font-bold transition flex items-center space-x-2">
                <span>Ronda {{ $ronda }}</span>
                <span class="text-sm bg-gray-800 text-white px-2 py-1 rounded">
                    {{ $partidosRonda->where('estado', 'jugado')->count() }}/{{ $partidosRonda->count() }}
                </span>
            </button>
            @endforeach
        </div>
    </div>

    <!-- Contenido de rondas -->
    @foreach($partidos as $ronda => $partidosRonda)
    <div x-show="activeTab === 'ronda{{ $ronda }}'" class="space-y-4">
        <h2 class="text-2xl font-bold text-white text-center mb-6">
            Ronda {{ $ronda }} - Enfrentamientos
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($partidosRonda as $partido)
            <div class="card-clash rounded-xl p-6 transition transform hover:scale-105">
                <div class="text-center mb-4">
                    <span class="bg-amber-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                        Partido {{ $loop->iteration }}
                    </span>
                </div>

                <div class="flex justify-between items-center space-x-4">
                    <!-- Jugador 1 -->
                    <div class="flex-1 text-center">
                        <template x-if="esAdmin && '{{ $partido->estado }}' === 'pendiente'">
                            <button onclick="registrarGanador({{ $partido->id }}, {{ $partido->jugador1_id }})"
                                    class="w-full py-3 px-4 rounded-lg font-bold bg-blue-500 text-white border-2 border-blue-700 hover:bg-blue-600 transition">
                                👑 {{ $partido->jugador1->nombre }}
                            </button>
                        </template>
                        <template x-if="!esAdmin || '{{ $partido->estado }}' !== 'pendiente'">
                            <div class="w-full py-3 px-4 rounded-lg font-bold
                                        {{ $partido->estado == 'jugado' ?
                                          ($partido->ganador_id == $partido->jugador1_id ?
                                           'bg-green-500 text-white border-2 border-green-700' :
                                           'bg-red-500 text-white border-2 border-red-700') :
                                          'bg-gray-400 text-gray-700 border-2 border-gray-500' }}">
                                👑 {{ $partido->jugador1->nombre }}
                            </div>
                        </template>
                    </div>

                    <!-- VS -->
                    <div class="flex-none">
                        <span class="bg-gray-800 text-white px-3 py-1 rounded-full font-bold">
                            VS
                        </span>
                    </div>

                    <!-- Jugador 2 -->
                    <div class="flex-1 text-center">
                        <template x-if="esAdmin && '{{ $partido->estado }}' === 'pendiente'">
                            <button onclick="registrarGanador({{ $partido->id }}, {{ $partido->jugador2_id }})"
                                    class="w-full py-3 px-4 rounded-lg font-bold bg-blue-500 text-white border-2 border-blue-700 hover:bg-blue-600 transition">
                                👑 {{ $partido->jugador2->nombre }}
                            </button>
                        </template>
                        <template x-if="!esAdmin || '{{ $partido->estado }}' !== 'pendiente'">
                            <div class="w-full py-3 px-4 rounded-lg font-bold
                                        {{ $partido->estado == 'jugado' ?
                                          ($partido->ganador_id == $partido->jugador2_id ?
                                           'bg-green-500 text-white border-2 border-green-700' :
                                           'bg-red-500 text-white border-2 border-red-700') :
                                          'bg-gray-400 text-gray-700 border-2 border-gray-500' }}">
                                👑 {{ $partido->jugador2->nombre }}
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Botón reiniciar (solo admin) -->
                @if($partido->estado == 'jugado')
                <div class="text-center mt-4" x-show="esAdmin">
                    <form action="{{ route('partido.reiniciar', $partido) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                                class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                            🔄 Reiniciar Partido
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Botón activar admin -->
        <div class="text-center mb-6" x-show="!esAdmin">
            <button @click="mostrarModal = true"
                    class="bg-gray-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-700 transition">
                🔑 Activar Modo Admin
            </button>
        </div>
    </div>
    @endforeach
    @endif
</div>

<!-- Form para registrar ganador -->
<form id="ganadorForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="ganador_id" id="ganadorInput">
</form>

<script>
function registrarGanador(partidoId, ganadorId) {
    if (confirm('¿Estás seguro de registrar este resultado?')) {
        document.getElementById('ganadorInput').value = ganadorId;
        const form = document.getElementById('ganadorForm');
        form.action = `/partido/${partidoId}/registrar-ganador`;
        form.submit();
    }
}
</script>
@endsection
