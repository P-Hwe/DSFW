@extends('layouts.app')
@section('titulo', 'Detalhes do empréstimo')
@section('conteudo')
<a href="{{ route('emprestimos.index') }}" class="text-brand-600 text-sm">← Voltar</a>

<div class="bg-white rounded-xl shadow-sm p-6 mt-4 max-w-xl">
    <h1 class="text-xl font-semibold mb-4">{{ $emprestimo->livro->titulo }}</h1>
    <dl class="space-y-2 text-sm">
        <div class="flex justify-between"><dt class="text-slate-500">Leitor</dt><dd>{{ $emprestimo->leitor->name }}</dd></div>
        <div class="flex justify-between"><dt class="text-slate-500">Registrado por</dt><dd>{{ $emprestimo->responsavel->name ?? '—' }}</dd></div>
        <div class="flex justify-between"><dt class="text-slate-500">Data do empréstimo</dt><dd>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</dd></div>
        <div class="flex justify-between"><dt class="text-slate-500">Devolução prevista</dt><dd>{{ $emprestimo->data_prevista_devolucao->format('d/m/Y') }}</dd></div>
        <div class="flex justify-between"><dt class="text-slate-500">Devolução efetiva</dt><dd>{{ $emprestimo->data_devolucao?->format('d/m/Y') ?? '—' }}</dd></div>
        <div class="flex justify-between"><dt class="text-slate-500">Status</dt><dd>{{ ucfirst($emprestimo->status) }}</dd></div>
    </dl>

    @if($emprestimo->status !== 'devolvido')
    <form action="{{ route('emprestimos.devolver', $emprestimo) }}" method="POST" class="mt-6" onsubmit="return confirm('Registrar devolução?')">
        @csrf @method('PATCH')
        <button class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Registrar devolução</button>
    </form>
    @endif
</div>
@endsection
