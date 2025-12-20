<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvingut al Kanban</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #ffffff;
            color: #1b1b18;
            font-family: 'Arial', sans-serif;
        }
        .btn-verd {
            background-color: #c7e29d;
            color: #1b1b18;
        }
        .btn-roig {
            background-color: #7e1c1c;
            color: #ffffff;
        }
        .btn-verd:hover, .btn-roig:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-6">

    <!-- Header amb botons -->
    <header class="w-full max-w-4xl flex justify-end gap-4 mb-6">
        <a href="/login" class="px-5 py-2 rounded btn-verd transition">Inicia Sessió</a>
        <a href="/register" class="px-5 py-2 rounded btn-roig transition">Registra't</a>
    </header>

    <!-- Contingut principal -->
    <main class="flex flex-col-reverse lg:flex-row w-full max-w-4xl gap-8 items-center">
        <!-- Textual -->
        <div class="flex-1 p-8 shadow rounded-lg">
            <h1 class="text-3xl font-bold mb-4">Benvingut al Simulador Kanban</h1>
            <p class="mb-4">
                Aquesta eina està dissenyada per ajudar-te a gestionar tasques amb el mètode Kanban. 
                Pots organitzar projectes, assignar tasques i fer un seguiment fàcil i visual.
            </p>
            <p class="mb-6">
                Per començar, consulta el manual d'usuari per entendre com funciona tot:
            </p>
            <a href="https://institutcampalans-team-lf3flsyc.atlassian.net/wiki/spaces/DDS/pages/458941/Manual+d+Usuari+Simulador+Kanban+DAW2" 
               target="_blank" 
               class="px-4 py-2 rounded btn-verd font-medium transition">
               Manual d'Usuari
            </a>
        </div>

        <!-- Imatge -->
        <div class="flex-1 flex items-center justify-center">
            <img src="{{ asset('images/KanBan.png') }}" class="rounded-full w-40 h-40 object-cover">
        </div>


        </div>
    </main>
    
</body>
</html>
