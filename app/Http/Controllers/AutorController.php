<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Models\Autor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AutorController extends Controller
{
    public function index(): View
    {
        $autores = Autor::withCount('livros')->orderBy('nome')->paginate(10);

        return view('autores.index', compact('autores'));
    }

    public function create(): View
    {
        return view('autores.create');
    }

    public function store(AutorRequest $request): RedirectResponse
    {
        Autor::create($request->validated());

        return redirect()->route('autores.index')->with('sucesso', 'Autor cadastrado com sucesso.');
    }

    public function edit(Autor $autor): View
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(AutorRequest $request, Autor $autor): RedirectResponse
    {
        $autor->update($request->validated());

        return redirect()->route('autores.index')->with('sucesso', 'Autor atualizado com sucesso.');
    }

    public function destroy(Autor $autor): RedirectResponse
    {
        if ($autor->livros()->exists()) {
            return back()->with('erro', 'Não é possível excluir: existem livros desse autor.');
        }

        $autor->delete();

        return redirect()->route('autores.index')->with('sucesso', 'Autor removido com sucesso.');
    }
}
