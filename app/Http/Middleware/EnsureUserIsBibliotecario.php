<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Garante que apenas usuários com perfil 'admin' ou 'bibliotecario'
 * possam acessar rotas de gestão do acervo e dos empréstimos.
 */
class EnsureUserIsBibliotecario
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isBibliotecario()) {
            abort(403, 'Acesso restrito a bibliotecários e administradores.');
        }

        return $next($request);
    }
}
