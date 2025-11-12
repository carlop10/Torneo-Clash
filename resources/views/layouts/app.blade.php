<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneo Clash Royale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .bg-clash {
            background: linear-gradient(135deg, #1e3a8a 0%, #7e22ce 100%);
        }
        .card-clash {
            background: linear-gradient(145deg, #fef3c7, #fde68a);
            border: 3px solid #d97706;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        .btn-royale {
            background: linear-gradient(145deg, #f59e0b, #d97706);
            border: 2px solid #92400e;
        }
        .btn-royale:hover {
            background: linear-gradient(145deg, #d97706, #b45309);
        }
    </style>
</head>
<body class="bg-clash min-h-screen">
    <!-- Header -->
    <header class="bg-yellow-500 border-b-4 border-amber-700 shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900 drop-shadow-lg">
                    🏆 Torneo Clash Royale
                </h1>
                <div class="flex space-x-4">
                    <a href="{{ route('enfrentamientos') }}"
                       class="btn-royale px-6 py-2 rounded-lg font-bold text-white transition transform hover:scale-105">
                       ⚔️ Enfrentamientos
                    </a>
                    <a href="{{ route('clasificacion') }}"
                       class="btn-royale px-6 py-2 rounded-lg font-bold text-white transition transform hover:scale-105">
                       📊 Clasificación
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Progress Bar -->
    @if(isset($progreso))
    <div class="bg-amber-900 py-2">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between text-white">
                <span class="font-bold">Progreso del Torneo:</span>
                <span class="font-bold">{{ $progreso }}%</span>
            </div>
            <div class="w-full bg-amber-200 rounded-full h-4 mt-1">
                <div class="bg-green-500 h-4 rounded-full transition-all duration-500"
                     style="width: {{ $progreso }}%"></div>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>Torneo Privado - ¡Que gane el mejor! 👑</p>
        </div>
    </footer>
</body>
</html>
