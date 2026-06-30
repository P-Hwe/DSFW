@extends('layouts.app')
@section('titulo', 'Editar categoria')
@section('conteudo')
<h1 class="text-2xl font-semibold mb-6">Editar categoria</h1>
<form action="{{ route('categorias.update', $categoria) }}" method="POST" class="bg-white rounded-xl shadow-sm p-6 max-w-lg space-y-4">
    @csrf @method('PUT')
    @include('categorias._form')
    <button class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Atualizar</button>
</form>
@endsection
