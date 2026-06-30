@php($autor = $autor ?? null)
<div>
    <label class="block text-sm font-medium mb-1">Nome</label>
    <input type="text" name="nome" value="{{ old('nome', $autor->nome ?? '') }}"
           class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
    @error('nome') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
<div>
    <label class="block text-sm font-medium mb-1">Nacionalidade</label>
    <input type="text" name="nacionalidade" value="{{ old('nacionalidade', $autor->nacionalidade ?? '') }}"
           class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">
    @error('nacionalidade') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
<div>
    <label class="block text-sm font-medium mb-1">Biografia</label>
    <textarea name="biografia" rows="3" class="w-full rounded-lg border-slate-300 focus:ring-brand-500 focus:border-brand-500">{{ old('biografia', $autor->biografia ?? '') }}</textarea>
    @error('biografia') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
