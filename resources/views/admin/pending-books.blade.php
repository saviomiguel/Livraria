<!DOCTYPE html>  
<html lang="pt-BR">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Livros Pendentes para Revisão - Livraria</title>  
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
        .book-card {  
            background: rgba(121, 67, 67, 0.2);  
            border-radius: 10px;  
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  
            overflow: hidden;  
            margin-bottom: 20px;  
            backdrop-filter: blur(5px);  
        }  
        .book-card img {  
            width: 100%;  
            height: 300px;  
            object-fit: cover;  
        }  
        .book-card .card-body {  
            padding: 15px;  
            color: white;  
        }  
        .btn-read {  
            background-color: #007bff;  
            color: white;  
        }  
        .btn-download {  
            background-color: #28a745;  
            color: white;  
        }  
        .footer {  
            background: rgba(0, 0, 0, 0.8);  
            padding: 20px;  
            text-align: center;  
            margin-top: auto;  
        }  
    </style>  
</head>  
<body>  
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm">  
        <div class="container">  
            <a class="navbar-brand" href="{{ route('principal') }}">Livraria</a>  
        </div>  
    </nav>  

    <div class="container mt-5">  
        <h2 class="font-semibold text-xl text-center">{{ __('Livros Pendentes para Revisão') }}</h2>  

        <div class="row mt-4">  
            @forelse ($books as $book)  
                <div class="col-md-4">  
                    <div class="book-card p-3">  
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">  
                        <div class="card-body">  
                            <h5 class="card-title text-center">{{ $book->title }}</h5> 
                            <p><strong>Publicado por:</strong> {{ $book->user->name }} em: {{ $book->created_at->format('d/m/Y H:i') }}</p>  
                            
                            <!-- Links para Baixar ou Ler -->  
                            <div class="mt-4">  
                                <a href="{{ route('books.download', $book->id) }}" class="btn btn-download">Baixar Livro</a>  
                                <a href="{{ route('books.read', $book->id) }}" class="btn btn-read">Ler Livro</a>  
                            </div>  
                            <!-- Ações do Administrador -->  
                            <div class="mt-4 d-flex align-items-center">  
                                <form action="{{ route('books.approve', $book) }}" method="POST" class="d-flex align-items-center">  
                                    @csrf   
                                    <select name="category_id" id="category_id" class="form-select me-2">  
                                        @foreach ($categories as $category)  
                                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>  
                                                {{ $category->name }}  
                                            </option>  
                                        @endforeach  
                                    </select>  
                                    <button type="submit" class="btn btn-success me-1">Aprovar</button>  
                                </form>  

                                <form action="{{ route('books.reject', $book) }}" method="POST" class="d-inline">  
                                    @csrf  
                                    <button type="submit" class="btn btn-danger">Rejeitar</button>  
                                </form>  
                            </div> 
                        </div>  
                    </div>  
                </div>  
            @empty  
                <div class="col-12 text-center">  
                    <p class="text-gray-700">Nenhum livro pendente no momento.</p>  
                </div>  
            @endforelse  
        </div> 
        <!-- Paginação -->
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div> 
    </div>  

    <footer class="footer text-light">  
        <p>&copy; 2025 Livraria - Todos os direitos reservados.</p>  
    </footer>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>