@extends('layouts.app')
@section('titulo', 'Entrar')
@section('conteudo')
<div class="max-w-sm mx-auto bg-white rounded-xl shadow-sm p-8 mt-10">
    <h1 class="text-xl font-semibold text-center mb-6">Entrar na Biblioteca</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 text-red-700 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Senha</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        </div>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember"> Lembrar de mim
        </label>
        <button class="w-full bg-brand-600 hover:bg-brand-700 text-white rounded-lg py-2.5 font-medium">Entrar</button>
    </form>

    <p class="text-sm text-center text-slate-500 mt-6">
        Não tem conta? <a href="{{ route('register') }}" class="text-brand-600 font-medium">Cadastre-se</a>
    </p>
</div>
@endsection
