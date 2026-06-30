<?php

namespace Tests\Feature;

use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmprestimoTest extends TestCase
{
    use RefreshDatabase;

    private function criarLivro(int $exemplares = 1): Livro
    {
        $autor = Autor::factory()->create();
        $categoria = Categoria::factory()->create();

        return Livro::factory()->create([
            'autor_id' => $autor->id,
            'categoria_id' => $categoria->id,
            'quantidade_total' => $exemplares,
            'quantidade_disponivel' => $exemplares,
        ]);
    }

    public function test_bibliotecario_pode_registrar_emprestimo(): void
    {
        $bibliotecario = User::factory()->create(['role' => 'bibliotecario']);
        $leitor = User::factory()->create(['role' => 'leitor']);
        $livro = $this->criarLivro(1);

        $response = $this->actingAs($bibliotecario)->post(route('emprestimos.store'), [
            'livro_id' => $livro->id,
            'user_id' => $leitor->id,
            'data_prevista_devolucao' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertRedirect(route('emprestimos.index'));
        $this->assertDatabaseHas('emprestimos', ['livro_id' => $livro->id, 'user_id' => $leitor->id]);
        $this->assertEquals(0, $livro->fresh()->quantidade_disponivel);
    }

    public function test_leitor_nao_pode_registrar_emprestimo(): void
    {
        $leitor = User::factory()->create(['role' => 'leitor']);
        $livro = $this->criarLivro(1);

        $response = $this->actingAs($leitor)->post(route('emprestimos.store'), [
            'livro_id' => $livro->id,
            'user_id' => $leitor->id,
            'data_prevista_devolucao' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertForbidden();
    }

    public function test_devolucao_libera_exemplar(): void
    {
        $bibliotecario = User::factory()->create(['role' => 'bibliotecario']);
        $leitor = User::factory()->create(['role' => 'leitor']);
        $livro = $this->criarLivro(1);

        $emprestimo = \App\Models\Emprestimo::create([
            'livro_id' => $livro->id,
            'user_id' => $leitor->id,
            'responsavel_id' => $bibliotecario->id,
            'data_emprestimo' => now(),
            'data_prevista_devolucao' => now()->addDays(7),
            'status' => 'emprestado',
        ]);
        $livro->decrement('quantidade_disponivel');

        $response = $this->actingAs($bibliotecario)->patch(route('emprestimos.devolver', $emprestimo));

        $response->assertRedirect(route('emprestimos.index'));
        $this->assertEquals('devolvido', $emprestimo->fresh()->status);
        $this->assertEquals(1, $livro->fresh()->quantidade_disponivel);
    }
}
