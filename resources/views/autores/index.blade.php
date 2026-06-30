@extends('layouts.app')
@section('titulo', 'Autores')
@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Autores</h1>
    <a href="{{ route('autores.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">+ Novo autor</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-100 text-slate-600 text-left">
            <tr>
                <th class="px-4 py-3">Nome</th>
                <th class="px-4 py-3">Nacionalidade</th>
                <th class="px-4 py-3">Livros</th>
                <th class="px-4 py-3 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($autores as $autor)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $autor->nome }}</td>
                <td class="px-4 py-3 text-slate-500">{{ $autor->nacionalidade ?? '—' }}</td>
                <td class="px-4 py-3">{{ $autor->livros_count }}</td>
                <td class="px-4 py-3 text-right space-x-2">
                    <a href="{{ route('autores.edit', $autor) }}" class="text-brand-600 hover:underline">Editar</a>
                    <form action="{{ route('autores.destroy', $autor) }}" method="POST" class="inline" onsubmit="return confirm('Excluir este autor?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Nenhum autor cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $autores->links() }}</div>
@endsection
