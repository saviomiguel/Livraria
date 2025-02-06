<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Livraria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Garante que o body ocupe toda a altura da tela */
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
        .login-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            margin-top: 20%
        }
        .footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
            margin-top: auto; /* Fixa o footer no final */
        }
        .content {
            flex: 1; /* Faz o conteúdo ocupar o espaço restante */
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
                <div class="login-container text-center">
                    <h3 class="mb-4">Acesse sua conta</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required autofocus autocomplete="username" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3 form-check text-start">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">Lembrar-me</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            @if (Route::has('password.request'))
                                <a class="text-light text-decoration-none" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                            @endif
                            <button type="submit" class="btn btn-light">Entrar</button>
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