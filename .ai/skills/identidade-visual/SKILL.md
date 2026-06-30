---
name: identidade-visual
description: Use sempre que for criar ou alterar qualquer tela (view Blade) do sistema, para manter layout, cores, tipografia e componentes padronizados em toda a aplicação.
---

# Skill: Identidade Visual — Biblioteca IFSP

## Stack visual
- Tailwind CSS via CDN (`<script src="https://cdn.tailwindcss.com"></script>"`), sem build step.
- Todas as páginas estendem `resources/views/layouts/app.blade.php`.

## Paleta de cores
- Cor primária (marca): `brand` (indigo) — `brand-600` para botões e links de ação, `brand-700` para a navbar.
- Sucesso: verde (`green-100`/`green-700`).
- Erro/alerta: vermelho (`red-100`/`red-700`).
- Atenção/pendente: âmbar (`amber-100`/`amber-700`).
- Fundo geral: `slate-50`. Texto: `slate-800`. Texto secundário: `slate-500`.

## Tipografia
- Fonte padrão do sistema (sans-serif do Tailwind), sem fontes customizadas.
- Títulos de página: `text-2xl font-semibold`.
- Títulos de card/seção: `font-semibold`.
- Texto auxiliar: `text-sm text-slate-500`.

## Componentes padronizados
- **Cards**: `bg-white rounded-xl shadow-sm p-5` (ou `p-6` em formulários).
- **Botão primário**: `bg-brand-600 hover:bg-brand-700 text-white rounded-lg px-4 py-2 text-sm font-medium`.
- **Botão secundário**: `bg-white border border-slate-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-slate-100`.
- **Tabelas**: cabeçalho `bg-slate-100 text-slate-600`, linhas separadas por `divide-y`.
- **Badges de status**: pílula `px-2 py-1 rounded-full text-xs` com a cor semântica correspondente.
- **Mensagens flash**: usar sempre as chaves de sessão `sucesso` e `erro`, renderizadas automaticamente pelo layout base.

## Responsividade
- Grids usam `grid-cols-1` em telas pequenas, expandindo com `sm:`/`md:`/`lg:` (ex.: `grid-cols-2 md:grid-cols-4` no dashboard, `sm:grid-cols-2 lg:grid-cols-3` no acervo).
- Container principal: `max-w-6xl mx-auto px-4`. Formulários usam `max-w-lg` ou `max-w-2xl`.

## UX
- Toda ação destrutiva (excluir) usa `onsubmit="return confirm(...)"`.
- Erros de validação aparecem abaixo do campo correspondente (`@error('campo')`), nunca apenas no topo da página.
- Navegação principal sempre visível na navbar para usuários autenticados; itens de gestão (Categorias, Autores, Empréstimos) só aparecem para `bibliotecario`/`admin`.

Sempre que criar uma nova tela, reutilize esses padrões em vez de inventar novas classes/cores.
