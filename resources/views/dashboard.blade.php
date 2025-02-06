<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
        }

        html, body {  
            height: 100%; /* Isso garante que o corpo ocupe a altura total da tela */  
            margin: 0; /* Remove margens do corpo */  
        }  

        .footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
            margin-top: 50px;
        }
        .navbar-brand {
            font-family: 'Georgia', serif;
            font-size: 2rem;
            font-weight: bold;
            color: white !important;
        }
        .nav-link, .dropdown-item {
            font-size: 1.1rem;
            color: white !important;
        }
        
        .dropdown-menu {
            background-color: white !important;
        }

        .dropdown-item {
            color: rgb(26, 25, 25) !important;
        }

        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.1) !important;
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
        .btn-publish {
            background-color: #ff5722;
            color: white;
            font-weight: bold;
        }
        .btn-publish:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('principal') }}">Livraria</a>
    
            <!-- Botão de menu para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDashboard" aria-controls="navbarNavDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDashboard">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    
    
    <div class="container mt-5">
        <h2 class="text-center">Dashboard</h2>
        <div class="text-center mt-3">
            <a href="{{ route('books.create') }}" class="btn btn-publish">Publicar um Livro</a>
        </div>
        
        @if(Auth::user()->is_admin)
        <div class="text-center mt-3">
            <a href="{{ route('admin.pending-books') }}" class="btn btn-warning">Revisar Livros Pendentes</a>
        </div>
        @endif

        <div class="mt-5">
            <h3 class="text-center">Seus Livros</h3>
            @if($books->isEmpty())
                <p class="text-center text-light">Você ainda não publicou nenhum livro.</p>
            @else
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-md-4">
                            <div class="book-card p-3">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="text-sm">Status: <span class="fw-bold {{ $book->status === 'approved' ? 'text-success' : ($book->status === 'pending' ? 'text-warning' : 'text-danger') }}">{{ ucfirst($book->status) }}</span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Paginação -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
           
    </div>

    <footer class="footer text-light text-center mt-5 p-3" style="background: rgba(0, 0, 0, 0.8);">
        <p>&copy; 2025 Livraria - Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
