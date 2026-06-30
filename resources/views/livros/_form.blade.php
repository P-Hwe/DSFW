@php($livro = $livro ?? null)
<div class="grid sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <label class="block text-sm font-medium mb-1">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $livro->titulo ?? '') }}"
               class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        @error('titulo') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Autor</label>
        <select name="autor_id" class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
            <option value="">Selecione...</option>
            @foreach($autores as $autor)
                <option value="{{ $autor->id }}" @selected(old('autor_id', $livro->autor_id ?? '') == $autor->id)>{{ $autor->nome }}</option>
            @endforeach
        </select>
        @error('autor_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Categoria</label>
        <select name="categoria_id" class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
            <option value="">Selecione...</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(old('categoria_id', $livro->categoria_id ?? '') == $categoria->id)>{{ $categoria->nome }}</option>
            @endforeach
        </select>
        @error('categoria_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">ISBN</label>
        <input type="text" name="isbn" value="{{ old('isbn', $livro->isbn ?? '') }}"
               class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        @error('isbn') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ano de publicação</label>
        <input type="number" name="ano_publicacao" value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}"
               class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        @error('ano_publicacao') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Quantidade total de exemplares</label>
        <input type="number" min="1" name="quantidade_total" value="{{ old('quantidade_total', $livro->quantidade_total ?? 1) }}"
               class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
        @error('quantidade_total') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
