---
name: seguranca
description: Use ao implementar autenticação, autorização ou qualquer rota/funcionalidade que exponha ou modifique dados sensíveis, para garantir que as boas práticas de segurança do Laravel sejam seguidas.
---

# Skill: Segurança — Biblioteca IFSP

## Autenticação
- Senhas sempre via `Hash::make()` / cast `'password' => 'hashed'` no Model `User` — nunca texto puro.
- Login via `Auth::attempt()` com `$request->session()->regenerate()` após sucesso, para evitar session fixation.
- Logout sempre invalida a sessão (`session()->invalidate()`) e regenera o token CSRF (`regenerateToken()`).
- Cadastro público sempre cria usuários com `role = 'leitor'`; nunca permitir que o próprio formulário de registro defina `admin`/`bibliotecario`.

## Autorização
- Rotas administrativas (CRUD de catálogo e empréstimos) ficam atrás do middleware `bibliotecario`, que verifica `role` no model `User`.
- Form Requests implementam `authorize()` com a mesma checagem de perfil — autorização é validada tanto na rota quanto na request, nunca só na View (não esconder botão é suficiente).
- Nunca confiar em campos ocultos do formulário para determinar permissões (ex.: não aceitar `role` vindo do formulário de registro).

## Proteção de dados
- Todos os formulários POST/PUT/PATCH/DELETE usam `@csrf` (proteção CSRF nativa do Laravel).
- Mass assignment controlado via `$fillable` em cada Model — nunca `$guarded = []`.
- Toda entrada de usuário é validada via Form Request antes de chegar ao banco (sem `DB::raw` com valores não tratados).

## Boas práticas gerais
- `.env` nunca é versionado (mantido no `.gitignore` padrão do Laravel); usar `.env.example` no repositório.
- Mensagens de erro de autenticação são genéricas ("credenciais não conferem"), sem indicar se o e-mail existe ou não.
- Em produção, `APP_DEBUG=false` para não vazar stack traces.

Sempre que tocar em autenticação, autorização ou dados de usuário, revise esta lista antes de finalizar a tarefa.
