<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'EventoYa')</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }
        nav {
            width: 220px;
            background: #343a40;
            color: white;
            padding: 20px;
        }
        nav h2 {
            font-size: 22px;
            margin-bottom: 30px;
        }
        nav a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 15px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            flex: 1;
            padding: 30px;
            background: #f4f4f4;
            overflow-y: auto;
        }
        .mensaje-exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <h2>📅 EventoYa</h2>
        <a href="{{ route('eventos.index') }}">📋 Ver eventos</a>
        <a href="{{ route('eventos.create') }}">📝 Proponer evento</a>
    </nav>
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>

