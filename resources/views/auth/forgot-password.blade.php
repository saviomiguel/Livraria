<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Livraria</title>
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
        .password-reset-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            margin-top: 20%;
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
                <div class="password-reset-container text-center">
                    <h3 class="mb-4">Recuperar Senha</h3>
                    <p class="text-light">Esqueceu sua senha? Insira seu email abaixo e enviaremos um link para redefini-la.</p>
                    
                    <!-- Exibir status da sessão caso o email tenha sido enviado -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>
                        <button type="submit" class="btn btn-light w-100">Enviar Link de Redefinição</button>
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
