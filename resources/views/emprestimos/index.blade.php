@extends('layouts.app')
@section('titulo', 'Empréstimos')
@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Empréstimos</h1>
    <a href="{{ route('emprestimos.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">+ Novo empréstimo</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-100 text-slate-600 text-left">
            <tr>
                <th class="px-4 py-3">Livro</th>
                <th class="px-4 py-3">Leitor</th>
                <th class="px-4 py-3">Devolução prevista</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($emprestimos as $emprestimo)
            <tr>
                <td class="px-4 py-3"><a href="{{ route('emprestimos.show', $emprestimo) }}" class="text-brand-600 hover:underline">{{ $emprestimo->livro->titulo }}</a></td>
                <td class="px-4 py-3">{{ $emprestimo->leitor->name }}</td>
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
                <td class="px-4 py-3 text-right">
                    @if($emprestimo->status !== 'devolvido')
                    <form action="{{ route('emprestimos.devolver', $emprestimo) }}" method="POST" class="inline" onsubmit="return confirm('Registrar devolução?')">
                        @csrf @method('PATCH')
                        <button class="text-brand-600 hover:underline">Registrar devolução</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-6 text-center text-slate-400">Nenhum empréstimo registrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $emprestimos->links() }}</div>
@endsection
