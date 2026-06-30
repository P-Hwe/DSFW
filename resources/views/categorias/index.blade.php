@extends('layouts.app')
@section('titulo', 'Categorias')
@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">+ Nova categoria</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-100 text-slate-600 text-left">
            <tr>
                <th class="px-4 py-3">Nome</th>
                <th class="px-4 py-3">Descrição</th>
                <th class="px-4 py-3">Livros</th>
                <th class="px-4 py-3 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($categorias as $categoria)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $categoria->nome }}</td>
                <td class="px-4 py-3 text-slate-500">{{ $categoria->descricao ?? '—' }}</td>
                <td class="px-4 py-3">{{ $categoria->livros_count }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-brand-600 hover:underline">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline" onsubmit="return confirm('Excluir esta categoria?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Nenhuma categoria cadastrada.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $categorias->links() }}</div>
@endsection
