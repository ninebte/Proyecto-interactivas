<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --naruto-orange: #FE9A37;
            --pokemon-blue: #3B5BA7;
            --leaf-green: #4CAF50;
        }

        body {
            background: url('/api/placeholder/1920/1080') center/cover no-repeat fixed;
            min-height: 100vh;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(254, 154, 55, 0.95), rgba(59, 91, 167, 0.95));
            z-index: -1;
        }

        .dashboard-container {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .welcome-text {
            color: var(--naruto-orange);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .ninja-info {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .btn-custom {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: 0.5s;
        }

        .btn-custom:hover::before {
            transform: translateX(100%);
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-logout:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
        }

        .btn-pokemon {
            background-color: var(--pokemon-blue);
            color: white;
            border: none;
        }

        .btn-pokemon:hover {
            background-color: #2a4178;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 91, 167, 0.4);
            color: white;
        }

        .dashboard-icons {
            font-size: 2rem;
            margin: 2rem 0;
        }

        .dashboard-icon {
            margin: 0 1rem;
            color: var(--naruto-orange);
            transition: transform 0.3s ease;
        }

        .dashboard-icon:hover {
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .welcome-text {
                font-size: 2rem;
            }

            .dashboard-container {
                padding: 1.5rem;
                margin: 1rem;
            }

            .btn-custom {
                width: 100%;
                margin: 0.5rem 0;
            }
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1rem 0;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="dashboard-container">
            <div class="text-center">
                <h1 class="welcome-text">¡Bienvenido, {{ $user->name }}!</h1>
                <p class="ninja-info">Has iniciado sesión exitosamente en el mundo ninja y Pokémon</p>

                <div class="dashboard-icons">
                    <i class="fas fa-fire dashboard-icon" title="Chakra"></i>
                    <i class="fas fa-dragon dashboard-icon" title="Pokemon"></i>
                    <i class="fas fa-star dashboard-icon" title="Ninja"></i>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="feature-card">
                            <h3 class="mb-3" style="color: var(--pokemon-blue);">Tu Portal de Aventuras</h3>
                            <p>Explora el fascinante mundo de Pokémon y las aventuras ninja</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ route('pokemon.search') }}" class="btn btn-custom btn-pokemon">
                                    <i class="fas fa-search me-2"></i>Ver Películas
                                </a>
                                <a href="{{ route('logout') }}" class="btn btn-custom btn-logout">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>