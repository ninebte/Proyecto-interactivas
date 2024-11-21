<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center">
            <h1>Bienvenido, {{ $user->name }}!</h1>
            <p class="lead">Has iniciado sesión exitosamente.</p>
            <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    <div class="text-center mt-3">
        <a href="{{ route('pokemon.search') }}" class="btn btn-primary">Ver Películas</a>
    </div>
    </div>
</body>
</html>
