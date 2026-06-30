<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Livro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LivroController extends Controller
{
    public function index(Request $request): View
    {
        $livros = Livro::with(['autor', 'categoria'])
            ->when($request->filled('busca'), function ($query) use ($request) {
                $query->where('titulo', 'like', '%' . $request->string('busca') . '%');
            })
            ->when($request->filled('categoria_id'), function ($query) use ($request) {
                $query->where('categoria_id', $request->integer('categoria_id'));
            })
            ->orderBy('titulo')
            ->paginate(10)
            ->withQueryString();

        $categorias = Categoria::orderBy('nome')->get();

        return view('livros.index', compact('livros', 'categorias'));
    }

    public function create(): View
    {
        $autores = Autor::orderBy('nome')->get();
        $categorias = Categoria::orderBy('nome')->get();

        return view('livros.create', compact('autores', 'categorias'));
    }

    public function store(LivroRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['quantidade_disponivel'] = $data['quantidade_total'];

        Livro::create($data);

        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso.');
    }

    public function show(Livro $livro): View
    {
        $livro->load(['autor', 'categoria', 'emprestimos' => fn ($q) => $q->latest('data_emprestimo')->with('leitor')]);

        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro): View
    {
        $autores = Autor::orderBy('nome')->get();
        $categorias = Categoria::orderBy('nome')->get();

        return view('livros.edit', compact('livro', 'autores', 'categorias'));
    }

    public function update(LivroRequest $request, Livro $livro): RedirectResponse
    {
        $data = $request->validated();

        // ajusta a quantidade disponível proporcionalmente caso o total mude
        $emprestados = $livro->quantidade_total - $livro->quantidade_disponivel;
        $data['quantidade_disponivel'] = max(0, $data['quantidade_total'] - $emprestados);

        $livro->update($data);

        return redirect()->route('livros.index')->with('sucesso', 'Livro atualizado com sucesso.');
    }

    public function destroy(Livro $livro): RedirectResponse
    {
        if ($livro->emprestimos()->where('status', 'emprestado')->exists()) {
            return back()->with('erro', 'Não é possível excluir: o livro possui empréstimos em aberto.');
        }

        $livro->delete();

        return redirect()->route('livros.index')->with('sucesso', 'Livro removido com sucesso.');
    }
}
