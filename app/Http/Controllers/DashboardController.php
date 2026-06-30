<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->isBibliotecario()) {
            $totalLivros = Livro::count();
            $totalExemplares = Livro::sum('quantidade_total');
            $emprestimosAtivos = Emprestimo::where('status', 'emprestado')->count();
            $emprestimosAtrasados = Emprestimo::where('status', 'emprestado')
                ->where('data_prevista_devolucao', '<', now())
                ->count();

            return view('dashboard', compact('totalLivros', 'totalExemplares', 'emprestimosAtivos', 'emprestimosAtrasados'));
        }

        $meusEmprestimos = Emprestimo::with('livro')
            ->where('user_id', $user->id)
            ->latest('data_emprestimo')
            ->get();

        return view('dashboard', compact('meusEmprestimos'));
    }
}
