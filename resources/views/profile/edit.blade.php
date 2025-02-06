<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Perfil</title>  
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
        .profile-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            backdrop-filter: blur(5px);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('principal') }}">Livraria</a>
    
            <!-- Botão de menu para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavResponsive" aria-controls="navbarNavResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavResponsive">
                <ul class="navbar-nav">
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
                </ul>
            </div>
        </div>
    </nav>    

    <div class="container mt-5">
        <h2 class="text-center mb-4">Perfil</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 profile-card">
                <h4 class="mb-3">Informações do Perfil</h4>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 profile-card">
                <h4 class="mb-3">Atualizar Senha</h4>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> 
</body>  
</html>