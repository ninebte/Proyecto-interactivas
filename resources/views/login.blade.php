<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .login-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .login-header h3 {
            color: #333;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.25);
            border-color: #667eea;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #764ba2;
            z-index: 10;
        }

        .icon-input {
            padding-left: 2.8rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-card">
                    <div class="login-header">
                        <h3>Bienvenido</h3>
                        <p class="text-muted">Ingresa tus credenciales</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email"
                                    class="form-control icon-input"
                                    id="email"
                                    name="email"
                                    placeholder="Correo Electrónico"
                                    required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="input-group">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password"
                                    class="form-control icon-input"
                                    id="password"
                                    name="password"
                                    placeholder="Contraseña"
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-login text-white w-100">
                            Iniciar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>