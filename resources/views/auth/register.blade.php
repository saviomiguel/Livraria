<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Livraria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar-brand {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            font-weight: bold;
            color: white !important;
        }
        .nav-link {
            font-size: 1.1rem;
            color: white !important;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            margin-top: 10%;
        }
        .footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('principal') }}">Livraria</a>
        </div>
    </nav>

    <div class="container mt-5 content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="register-container text-center">
                    <h3 class="mb-4">Criar Conta</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 text-start">
                            <label for="name" class="form-label">Nome</label>
                            <input id="name" type="text" name="name" class="form-control" required autofocus autocomplete="name" value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required autocomplete="username" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                        </div>

                        <div class="d-flex justify-content-between">
                            <a class="text-light text-decoration-none" href="{{ route('login') }}">Já tem uma conta?</a>
                            <button type="submit" class="btn btn-light">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-light">
        <p>&copy; 2025 Livraria - Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
