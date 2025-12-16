<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'KanBan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full px-6 py-4 flex justify-end items-center shadow-sm">
        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition">
                        Inicia sessió
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition">
                            Registrat
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Main content -->
    <main class="flex flex-1 items-center justify-center px-6 py-12">
        <div class="text-center">
            <!-- Imagen KanBan con estilo -->
            <div class="inline-block bg-gray-50 p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                <img src="{{ asset('images/KanBan.png') }}" alt="Logo KanBan" class="h-48 mx-auto">
            </div>

            <!-- Título -->
            <h1 class="mt-8 text-4xl font-extrabold text-gray-800">
                Benvingut a <span class="text-green-600">KanBan</span>
            </h1>

            <!-- Subtítulo -->
            <p class="mt-4 text-lg text-gray-600">
                Organitza les teves tasques de manera visual i senzilla.
            </p>

            <!-- Botón al dashboard -->
            <div class="mt-8">
                <a href="{{ route('dashboard') }}"
                   class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                   Ir al Dashboard
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-sm text-gray-400 border-t">
        © {{ date('Y') }} KanBan Project · Desenvolupat per Hayat
    </footer>
</body>
</html>
