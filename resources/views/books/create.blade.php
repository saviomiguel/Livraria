<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Publicar Livro - Livraria</title>  
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
        .publish-container {  
            background: rgba(255, 255, 255, 0.2);  
            padding: 30px;  
            border-radius: 10px;  
            backdrop-filter: blur(5px);  
            margin-top: 5%;  
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
        <div class="publish-container text-center">  
            <h1 class="mb-4">Publicar Livro</h1>  

            @if(session('success'))  
                <div class="alert alert-success">{{ session('success') }}</div>  
            @endif  

            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">  
                @csrf  
                
                <div class="mb-3 text-start">  
                    <label for="title" class="form-label">Título do Livro</label>  
                    <input type="text" name="title" id="title" class="form-control" required>  
                </div>  

                <div class="mb-3 text-start">  
                    <label for="description" class="form-label">Descrição</label>  
                    <textarea name="description" id="description" class="form-control"></textarea>  
                </div>  

                <div class="mb-3 text-start">  
                    <label for="category_id" class="form-label">Categoria</label>  
                    <select name="category_id" id="category_id" class="form-select" required>  
                        <option value="">Selecione uma categoria</option>  
                        @foreach($categories as $category)  
                            <option value="{{ $category->id }}">{{ $category->name }}</option>  
                        @endforeach  
                    </select>  
                </div>  

                <div class="mb-3 text-start">  
                    <label for="file_path" class="form-label">Arquivo</label>  
                    <input type="file" name="file_path" id="file_path" class="form-control" required>  
                </div>  

                <button type="submit" class="btn btn-primary">Publicar</button>  
            </form>  
        </div>  
    </div>  

    <footer class="footer text-light">  
        <p>&copy; 2025 Livraria - Todos os direitos reservados.</p>  
    </footer>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>