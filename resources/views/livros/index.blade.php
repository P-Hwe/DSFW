@extends('layouts.app')
@section('titulo', 'Acervo')
@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Acervo</h1>
    @if(auth()->user()->isBibliotecario())
        <a href="{{ route('livros.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">+ Novo livro</a>
    @endif
</div>

<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por título..."
           class="rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500 flex-1 min-w-[200px]">
    <select name="categoria_id" class="rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        <option value="">Todas as categorias</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>{{ $categoria->nome }}</option>
        @endforeach
    </select>
    <button class="bg-slate-200 hover:bg-slate-300 rounded-lg px-4 py-2 text-sm font-medium">Filtrar</button>
</form>

<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($livros as $livro)
    <a href="{{ route('livros.show', $livro) }}" class="bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition">
        <p class="font-semibold mb-1">{{ $livro->titulo }}</p>
        <p class="text-sm text-slate-500 mb-3">{{ $livro->autor->nome }} &middot; {{ $livro->categoria->nome }}</p>
        @if($livro->quantidade_disponivel > 0)
            <span class="text-green-700 bg-green-100 px-2 py-1 rounded-full text-xs">{{ $livro->quantidade_disponivel }} disponível(eis)</span>
        @else
            <span class="text-red-700 bg-red-100 px-2 py-1 rounded-full text-xs">Indisponível</span>
        @endif
    </a>
    @empty
    <p class="text-slate-400 col-span-full text-center py-10">Nenhum livro encontrado.</p>
    @endforelse
</div>
<div class="mt-6">{{ $livros->links() }}</div>
@endsection
