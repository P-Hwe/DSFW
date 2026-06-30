@extends('layouts.app')
@section('titulo', 'Editar livro')
@section('conteudo')
<h1 class="text-2xl font-semibold mb-6">Editar livro</h1>
<form action="{{ route('livros.update', $livro) }}" method="POST" class="bg-white rounded-xl shadow-sm p-6 max-w-2xl space-y-4">
    @csrf @method('PUT')
    @include('livros._form')
    <button class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Atualizar</button>
</form>
@endsection
