<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/registro', [RegisterController::class, 'create'])->name('register');
    Route::post('/registro', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Área autenticada (qualquer perfil)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Catálogo: leitura liberada para todos os usuários autenticados
    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/livros/{livro}', [LivroController::class, 'show'])->name('livros.show');

    // Gestão do acervo e empréstimos: apenas bibliotecário/admin
    Route::middleware('bibliotecario')->group(function () {
        Route::resource('categorias', CategoriaController::class)->except(['show']);
        Route::resource('autores', AutorController::class)->except(['show']);
        Route::resource('livros', LivroController::class)->except(['index', 'show']);

        Route::resource('emprestimos', EmprestimoController::class)->only(['index', 'create', 'store', 'show']);
        Route::patch('/emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
    });
});
