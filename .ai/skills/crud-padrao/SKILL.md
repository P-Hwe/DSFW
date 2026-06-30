---
name: crud-padrao
description: Use sempre que for criar, revisar ou estender qualquer funcionalidade de CRUD (Categorias, Autores, Livros, Empréstimos ou novas entidades) para manter a mesma estrutura em todo o projeto.
---

# Skill: Padrão de CRUD — Biblioteca IFSP

## Estrutura de pastas
- Controller: `app/Http/Controllers/{Entidade}Controller.php`, sempre um `Controller` "resourceful" (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy` quando aplicável).
- Validação: sempre em uma Form Request dedicada `app/Http/Requests/{Entidade}Request.php`, nunca `$request->validate()` direto no controller para entidades de CRUD.
- Rotas: `Route::resource()`, agrupadas por middleware de autorização quando necessário.
- Views: `resources/views/{entidades}/index.blade.php`, `create.blade.php`, `edit.blade.php` e um parcial `_form.blade.php` reaproveitado por `create` e `edit`.

## Form Requests
- Implementar `authorize()` verificando o perfil do usuário (ex.: `$this->user()?->isBibliotecario()`), nunca retornar `true` fixo em telas administrativas.
- Implementar `rules()` com regras explícitas (`required`, `max`, `unique` com `ignore()` no update, `exists` para chaves estrangeiras).
- Implementar `messages()` com mensagens em português, claras para o usuário final.

## Controllers
- `index()`: sempre paginado (`paginate(10)`), com `withCount`/`with` para evitar N+1.
- `store()`/`update()`: usar `$request->validated()`, nunca `$request->all()`.
- Regras de negócio que envolvem múltiplas tabelas (ex.: baixa de estoque em empréstimos) ficam no Controller ou em método do Model, nunca na View.
- Sempre retornar `redirect()->route(...)->with('sucesso', '...')` ou `back()->with('erro', '...')`.

## Views
- `index`: tabela ou grid + paginação (`{{ $registros->links() }}`) + estado vazio (`@forelse ... @empty`).
- `create`/`edit`: formulário único reaproveitado via `@include('{entidade}._form')`.
- Exclusão sempre via `<form method="POST">` com `@method('DELETE')` e confirmação JS.

## Banco de dados
- Toda entidade nova precisa de migration própria, com chaves estrangeiras (`foreignId()->constrained()`) e `cascadeOnDelete()`/`nullOnDelete()` definidos explicitamente.
- Não excluir registros que possuam dependências ativas (ex.: categoria com livros, livro com empréstimo em aberto) — validar antes do `delete()`.

Sempre que precisar adicionar um novo CRUD ao sistema, siga exatamente esse padrão.
