@extends('layouts.app')
@section('titulo', 'Novo empréstimo')
@section('conteudo')
<h1 class="text-2xl font-semibold mb-6">Novo empréstimo</h1>
<form action="{{ route('emprestimos.store') }}" method="POST" class="bg-white rounded-xl shadow-sm p-6 max-w-lg space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium mb-1">Livro</label>
        <select name="livro_id" class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
            <option value="">Selecione um livro disponível...</option>
            @foreach($livros as $livro)
                <option value="{{ $livro->id }}" @selected(old('livro_id') == $livro->id)>{{ $livro->titulo }} ({{ $livro->quantidade_disponivel }} disponível(eis))</option>
            @endforeach
        </select>
        @error('livro_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Leitor</label>
        <select name="user_id" class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
            <option value="">Selecione o leitor...</option>
            @foreach($leitores as $leitor)
                <option value="{{ $leitor->id }}" @selected(old('user_id') == $leitor->id)>{{ $leitor->name }} ({{ $leitor->email }})</option>
            @endforeach
        </select>
        @error('user_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Data prevista de devolução</label>
        <input type="date" name="data_prevista_devolucao" value="{{ old('data_prevista_devolucao', now()->addDays(14)->toDateString()) }}"
               class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        @error('data_prevista_devolucao') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <button class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Registrar empréstimo</button>
</form>
@endsection
