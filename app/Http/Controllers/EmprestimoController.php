<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoRequest;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmprestimoController extends Controller
{
    public function index(): View
    {
        $emprestimos = Emprestimo::with(['livro', 'leitor'])
            ->latest('data_emprestimo')
            ->paginate(10);

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create(): View
    {
        $livros = Livro::where('quantidade_disponivel', '>', 0)->orderBy('titulo')->get();
        $leitores = User::orderBy('name')->get();

        return view('emprestimos.create', compact('livros', 'leitores'));
    }

    public function store(EmprestimoRequest $request): RedirectResponse
    {
        $livro = Livro::findOrFail($request->validated('livro_id'));

        if ($livro->quantidade_disponivel < 1) {
            return back()->with('erro', 'Não há exemplares disponíveis desse livro no momento.');
        }

        Emprestimo::create([
            ...$request->validated(),
            'responsavel_id' => Auth::id(),
            'data_emprestimo' => now(),
            'status' => 'emprestado',
        ]);

        $livro->decrement('quantidade_disponivel');

        return redirect()->route('emprestimos.index')->with('sucesso', 'Empréstimo registrado com sucesso.');
    }

    public function show(Emprestimo $emprestimo): View
    {
        $emprestimo->load(['livro', 'leitor', 'responsavel']);

        return view('emprestimos.show', compact('emprestimo'));
    }

    public function devolver(Emprestimo $emprestimo): RedirectResponse
    {
        if ($emprestimo->status === 'devolvido') {
            return back()->with('erro', 'Este empréstimo já foi devolvido.');
        }

        $emprestimo->registrarDevolucao();

        return redirect()->route('emprestimos.index')->with('sucesso', 'Devolução registrada com sucesso.');
    }
}
