<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está autenticado e é um administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redireciona para a página inicial ou exibe uma mensagem de erro
        return redirect('/')->with('error', 'Você não tem permissão para acessar essa área.');
    }
}
