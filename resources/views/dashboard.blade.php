@extends('layouts.app')
@section('titulo', 'Painel')
@section('conteudo')

@if(auth()->user()->isBibliotecario())
    <h1 class="text-2xl font-semibold mb-6">Painel da Biblioteca</h1>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-sm text-slate-500">Livros cadastrados</p>
            <p class="text-3xl font-bold text-brand-700">{{ $totalLivros }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-sm text-slate-500">Exemplares no acervo</p>
            <p class="text-3xl font-bold text-brand-700">{{ $totalExemplares }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-sm text-slate-500">Empréstimos ativos</p>
            <p class="text-3xl font-bold text-brand-700">{{ $emprestimosAtivos }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-sm text-slate-500">Empréstimos atrasados</p>
            <p class="text-3xl font-bold text-red-600">{{ $emprestimosAtrasados }}</p>
        </div>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('emprestimos.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">+ Novo empréstimo</a>
        <a href="{{ route('livros.create') }}" class="bg-white border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-100">+ Novo livro</a>
    </div>
@else
    <h1 class="text-2xl font-semibold mb-6">Meus empréstimos</h1>
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-slate-600 text-left">
                <tr>
                    <th class="px-4 py-3">Livro</th>
                    <th class="px-4 py-3">Empréstimo</th>
                    <th class="px-4 py-3">Devolução prevista</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($meusEmprestimos as $emprestimo)
                <tr>
                    <td class="px-4 py-3">{{ $emprestimo->livro->titulo }}</td>
                    <td class="px-4 py-3">{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $emprestimo->data_prevista_devolucao->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        @if($emprestimo->status === 'devolvido')
                            <span class="text-green-700 bg-green-100 px-2 py-1 rounded-full text-xs">Devolvido</span>
                        @elseif($emprestimo->estaAtrasado())
                            <span class="text-red-700 bg-red-100 px-2 py-1 rounded-full text-xs">Atrasado</span>
                        @else
                            <span class="text-amber-700 bg-amber-100 px-2 py-1 rounded-full text-xs">Em andamento</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Você ainda não realizou nenhum empréstimo.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <a href="{{ route('livros.index') }}" class="inline-block mt-6 text-brand-600 font-medium text-sm">Ver acervo disponível →</a>
@endif
@endsection
