<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
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
        .search-section {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }
        .footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('principal') }}">Livraria</a>
            
            <!-- Botão de menu para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Registrar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>    
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="search-section text-center">
                    <h3 class="mb-4">Pesquise pelo nome (e ou) categoria do seu livro favorito</h3>
                    <form action="{{ route('principal') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="title" class="form-control" placeholder="Buscar por título" value="{{ request('title') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-control">
                                <option value="">Todas as categorias</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-light w-100">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Sobre a Livraria</h2>
        <p class="text-center">Nosso objetivo é fornecer acesso a livros incríveis gratuitamente. Explore nossa coleção e descubra novas histórias.</p>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Os nossos livros Livros</h2>
        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4">
                    <div class="book-card p-3">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('books.read', $book->id) }}" class="btn btn-read">Ler</a>
                                <a href="{{ route('books.download', $book->id) }}" class="btn btn-download">Baixar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Nenhum livro aprovado disponível no momento.</p>
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
