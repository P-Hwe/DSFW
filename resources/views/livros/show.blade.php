@extends('layouts.app')
@section('titulo', $livro->titulo)
@section('conteudo')
<a href="{{ route('livros.index') }}" class="text-brand-600 text-sm">← Voltar ao acervo</a>

<div class="bg-white rounded-xl shadow-sm p-6 mt-4">
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-semibold">{{ $livro->titulo }}</h1>
            <p class="text-slate-500 mt-1">{{ $livro->autor->nome }} &middot; {{ $livro->categoria->nome }} @if($livro->ano_publicacao) &middot; {{ $livro->ano_publicacao }} @endif</p>
        </div>
        @if(auth()->user()->isBibliotecario())
            <a href="{{ route('livros.edit', $livro) }}" class="text-brand-600 text-sm hover:underline">Editar</a>
        @endif
    </div>

    <div class="grid grid-cols-3 gap-4 mt-6">
        <div class="bg-slate-50 rounded-lg p-4 text-center">
            <p class="text-xs text-slate-500">ISBN</p>
            <p class="font-medium">{{ $livro->isbn ?? '—' }}</p>
        </div>
        <div class="bg-slate-50 rounded-lg p-4 text-center">
            <p class="text-xs text-slate-500">Exemplares totais</p>
            <p class="font-medium">{{ $livro->quantidade_total }}</p>
        </div>
        <div class="bg-slate-50 rounded-lg p-4 text-center">
            <p class="text-xs text-slate-500">Disponíveis</p>
            <p class="font-medium">{{ $livro->quantidade_disponivel }}</p>
        </div>
    </div>
</div>

@if(auth()->user()->isBibliotecario())
<div class="bg-white rounded-xl shadow-sm p-6 mt-6">
    <h2 class="font-semibold mb-4">Histórico de empréstimos</h2>
    <table class="w-full text-sm">
        <thead class="text-left text-slate-500">
            <tr><th class="py-2">Leitor</th><th class="py-2">Empréstimo</th><th class="py-2">Devolução prevista</th><th class="py-2">Status</th></tr>
        </thead>
        <tbody class="divide-y">
            @forelse($livro->emprestimos as $emprestimo)
            <tr>
                <td class="py-2">{{ $emprestimo->leitor->name }}</td>
                <td class="py-2">{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                <td class="py-2">{{ $emprestimo->data_prevista_devolucao->format('d/m/Y') }}</td>
                <td class="py-2">{{ ucfirst($emprestimo->status) }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="py-4 text-center text-slate-400">Sem empréstimos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endif
@endsection
