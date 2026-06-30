<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuários de teste (ver README.md para a lista completa)
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@biblioteca.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Bibliotecária Ana',
            'email' => 'bibliotecaria@biblioteca.test',
            'password' => Hash::make('password'),
            'role' => 'bibliotecario',
        ]);

        $leitor = User::create([
            'name' => 'Leitor João',
            'email' => 'leitor@biblioteca.test',
            'password' => Hash::make('password'),
            'role' => 'leitor',
        ]);

        // Categorias
        $categorias = collect(['Ficção', 'Tecnologia', 'História', 'Programação', 'Biografia'])
            ->map(fn ($nome) => Categoria::create(['nome' => $nome]));

        // Autores
        $autores = collect([
            ['nome' => 'Machado de Assis', 'nacionalidade' => 'Brasileira'],
            ['nome' => 'Robert C. Martin', 'nacionalidade' => 'Americana'],
            ['nome' => 'Yuval Noah Harari', 'nacionalidade' => 'Israelense'],
            ['nome' => 'Clarice Lispector', 'nacionalidade' => 'Brasileira'],
        ])->map(fn ($dados) => Autor::create($dados));

        // Livros
        $livros = [
            ['titulo' => 'Dom Casmurro', 'autor' => 0, 'categoria' => 0, 'qtd' => 3],
            ['titulo' => 'Clean Code', 'autor' => 1, 'categoria' => 3, 'qtd' => 2],
            ['titulo' => 'Sapiens: Uma Breve História da Humanidade', 'autor' => 2, 'categoria' => 2, 'qtd' => 4],
            ['titulo' => 'A Hora da Estrela', 'autor' => 3, 'categoria' => 0, 'qtd' => 2],
            ['titulo' => 'The Clean Coder', 'autor' => 1, 'categoria' => 3, 'qtd' => 1],
        ];

        $livrosCriados = collect($livros)->map(fn ($l) => Livro::create([
            'titulo' => $l['titulo'],
            'autor_id' => $autores[$l['autor']]->id,
            'categoria_id' => $categorias[$l['categoria']]->id,
            'quantidade_total' => $l['qtd'],
            'quantidade_disponivel' => $l['qtd'],
            'ano_publicacao' => random_int(1960, 2024),
        ]));

        // Empréstimo de exemplo (em aberto) para demonstrar o fluxo
        $livroEmprestado = $livrosCriados->first();
        Emprestimo::create([
            'livro_id' => $livroEmprestado->id,
            'user_id' => $leitor->id,
            'responsavel_id' => $admin->id,
            'data_emprestimo' => now()->subDays(5),
            'data_prevista_devolucao' => now()->addDays(2),
            'status' => 'emprestado',
        ]);
        $livroEmprestado->decrement('quantidade_disponivel');
    }
}
