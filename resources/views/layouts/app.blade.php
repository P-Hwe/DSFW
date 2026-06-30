<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Biblioteca IFSP')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50:'#eef2ff',100:'#e0e7ff',500:'#4f46e5',600:'#4338ca',700:'#3730a3' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    @auth
    <nav class="bg-brand-700 text-white">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between h-14">
            <a href="{{ route('dashboard') }}" class="font-semibold text-lg">📚 Biblioteca IFSP</a>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('livros.index') }}" class="hover:text-brand-100">Acervo</a>
                @if(auth()->user()->isBibliotecario())
                    <a href="{{ route('categorias.index') }}" class="hover:text-brand-100">Categorias</a>
                    <a href="{{ route('autores.index') }}" class="hover:text-brand-100">Autores</a>
                    <a href="{{ route('emprestimos.index') }}" class="hover:text-brand-100">Empréstimos</a>
                @endif
                <span class="text-brand-100">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-brand-600 hover:bg-brand-500 px-3 py-1.5 rounded-md">Sair</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <main class="flex-1 max-w-6xl w-full mx-auto px-4 py-8">
        @if(session('sucesso'))
            <div class="mb-6 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">{{ session('sucesso') }}</div>
        @endif
        @if(session('erro'))
            <div class="mb-6 rounded-lg bg-red-100 text-red-800 px-4 py-3 text-sm">{{ session('erro') }}</div>
        @endif

        @yield('conteudo')
    </main>

    <footer class="text-center text-xs text-slate-400 py-6">
        Biblioteca IFSP &middot; Atividade Laravel + Boost + Vibe Coding
    </footer>
</body>
</html>
