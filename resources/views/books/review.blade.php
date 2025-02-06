<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <title>Revisar Livro</title>  
    <style>  
        body {  
            background: linear-gradient(to right, #6a11cb, #2575fc);  
            color: white;  
            display: flex;  
            flex-direction: column;  
            min-height: 100vh;  
            justify-content: center; /* Centraliza verticalmente */  
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
        .footer {  
            background: rgba(0, 0, 0, 0.8);  
            padding: 20px;  
            text-align: center;  
            margin-top: auto;  
        }  
        .book-info {  
            background-color: rgba(255, 255, 255, 0.9); /* Fundo semi-transparente */  
            border-radius: 12px;  
            padding: 20px;  
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);  
            max-width: 600px; /* Largura máxima para alinhamento */  
            margin: auto; /* Centraliza horizontalmente */  
        }  
        .book-info h1, .book-info h2 {  
            color: #333; /* Cor escura para títulos */  
        }  
        .book-info h2 {  
            margin-top: 20px; /* Espaço acima dos subtítulos */  
            font-size: 1.5rem; /* Aumenta o tamanho do subtítulo */  
            text-align: center; /* Centraliza o subtítulo */  
        }  
        .book-info p {  
            color: #555; /* Cor mais escura para texto */  
            margin-bottom: 10px; /* Espaçamento entre parágrafos */  
        }  
        .label-category {  
            font-weight: bold; /* Destaca o texto da label */  
            font-size: 1.2rem; /* Aumenta o tamanho da fonte */  
            margin-bottom: 10px; /* Espaçamento abaixo da label */  
        }  
        .btn {  
            border-radius: 20px; /* Aumenta a curvatura dos botões */  
        }  
        .cat{
            color:black;
        }
    </style>  
</head>  
<body>  

    <header>  
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm">  
            <div class="container">  
                <a class="navbar-brand" href="{{ route('principal') }}">Livraria</a>  
            </div>  
        </nav>  
    </header>  

    <div class="content py-6">  
        <div class="container">  
            <!-- Informações do Livro -->  
            <div class="book-info shadow-sm mb-6">  
                <h1 class="text-2xl font-bold">{{ $book->title }}</h1>  
                <p class="mt-4"><strong>Descrição:</strong> {{ $book->description }}</p>  
                <p><strong>Autor:</strong> {{ $book->user->name }}</p>  
                <p><strong>Categoria:</strong> {{ $book->category->name }}</p>  
                <p><strong>Status:</strong> {{ ucfirst($book->status) }}</p>  
                <p><strong>Publicado em:</strong> {{ $book->created_at->format('d/m/Y H:i') }}</p>  

                <!-- Links para ações -->  
                <div class="mt-4">  
                    <a href="{{ route('books.download', $book->id) }}" class="btn btn-primary me-2">Baixar Livro</a>  
                    <a href="{{ route('books.read', $book->id) }}" class="btn btn-secondary">Ler Livro</a>  
                </div>  
            </div>  

            <!-- Ações do Administrador -->  
            @if ($book->status === 'pending')  
                <div class="book-info shadow-sm mb-6">  
                     
                    <div class="label-category text-center cat">Alterar Categoria:</div> <!-- Aumenta a visibilidade -->  
                    <form action="{{ route('books.approve', $book) }}" method="POST" class="mb-4">  
                        @csrf  
                        <div class="mb-4">  
                            <select name="category_id" id="category_id" class="form-select mt-2">  
                                @foreach ($categories as $category)  
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>  
                                        {{ $category->name }}  
                                    </option>  
                                @endforeach  
                            </select>  
                        </div>  
                        <button type="submit" class="btn btn-success">Aprovar</button>  
                    </form>  

                    <!-- Formulário de Rejeição -->  
                    <form action="{{ route('books.reject', $book) }}" method="POST">  
                        @csrf  
                        <button type="submit" class="btn btn-danger">Rejeitar</button>  
                    </form>  
                </div>  
            @else  
                <div class="book-info shadow-sm mb-6">  
                    <p><strong>Status:</strong> {{ ucfirst($book->status) }}</p>  
                </div>  
            @endif  
        </div>  
    </div>  

    <!-- Footer -->  
    <footer class="footer text-light pt-4 mt-auto">  
        <div class="container text-center">  
            <p>&copy; 2025 Livraria - Todos os direitos reservados.</p>  
        </div>  
    </footer>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>