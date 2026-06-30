@extends('layouts.app')
@section('titulo', 'Novo autor')
@section('conteudo')
<h1 class="text-2xl font-semibold mb-6">Novo autor</h1>
<form action="{{ route('autores.store') }}" method="POST" class="bg-white rounded-xl shadow-sm p-6 max-w-lg space-y-4">
    @csrf
    @include('autores._form')
    <button class="bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Salvar</button>
</form>
@endsection
