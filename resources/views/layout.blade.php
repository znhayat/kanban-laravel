<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Simulador Kanban</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="layout">
        <!-- Menú lateral -->
        <aside class="sidebar">
            <h2>Menú</h2>
            <ul>
                <li><a href="{{ route('usuaris.index') }}">Responsables</a></li>
                
            </ul>
        </aside>

        <!-- Contingut principal -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <p>© 2025 Simulador Kanban - DAW2</p>
    </footer>

</body>
</html>
