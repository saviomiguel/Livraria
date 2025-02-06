<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificação de Livro Publicado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            text-align: center;
        }
        .card h1 {
            font-size: 1.8rem;
            font-weight: bold;
        }
        .btn-custom {
            background-color: #ff7eb3;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 15px;
        }
        .btn-custom:hover {
            background-color: #ff5a92;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Notificação de Novo Livro Publicado!</h1>
        <p>Um novo livro foi publicado por <strong>{{ $book->user->name }}</strong>.</p>
        <p><strong>Título:</strong> {{ $book->title }}</p>
        <p>Caro administrador, tome as devidas decisões acessando o link abaixo:</p>
        <a href="{{ route('books.review', $book->id) }}" class="btn btn-custom">Revisar Livro</a>
    </div>
</body>
</html>
