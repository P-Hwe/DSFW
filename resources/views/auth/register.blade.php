@extends('layouts.app')
@section('titulo', 'Criar conta')
@section('conteudo')
<div class="max-w-sm mx-auto bg-white rounded-xl shadow-sm p-8 mt-10">
    <h1 class="text-xl font-semibold text-center mb-6">Criar conta de leitor</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 text-red-700 px-4 py-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Senha</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Confirmar senha</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <button class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-lg py-2.5 font-medium">Cadastrar</button>
    </form>

    <p class="text-sm text-center text-slate-500 mt-6">
        Já tem conta? <a href="{{ route('login') }}" class="text-brand-600 font-medium">Entrar</a>
    </p>
</div>
@endsection
