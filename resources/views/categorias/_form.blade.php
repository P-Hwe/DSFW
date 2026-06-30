@php($categoria = $categoria ?? null)
<div>
    <label class="block text-sm font-medium mb-1">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $categoria->nome ?? '') }}"
           class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
    @error('nome') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
<div>
    <label class="block text-sm font-medium mb-1">Descrição</label>
    <input type="text" name="descricao" value="{{ old('descricao', $categoria->descricao ?? '') }}"
           class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
    @error('descricao') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
