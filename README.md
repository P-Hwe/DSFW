# 📚 Biblioteca IFSP — Sistema de Gestão de Biblioteca e Empréstimos

Aplicação web em Laravel para gerenciar o acervo de uma biblioteca e controlar o ciclo de
empréstimo/devolução de livros, desenvolvida com apoio de IA (Vibe Coding) e Laravel Boost,
como atividade da disciplina de Desenvolvimento de Aplicações — IFSP Campus Guarulhos.

## Funcionalidades

- Autenticação (login, registro, logout), com perfis `leitor`, `bibliotecario` e `admin`.
- CRUD de Categorias, Autores e Livros (restrito a bibliotecário/admin).
- Catálogo de livros com busca por título e filtro por categoria.
- Registro de empréstimos e devoluções, com controle automático da quantidade de exemplares disponíveis.
- Painel (dashboard) com indicadores para o bibliotecário e lista de empréstimos para o leitor.

## Tecnologias utilizadas

- PHP 8.3+ / Laravel 11+
- Laravel Boost (MCP + AI Guidelines/Skills)
- SQLite (padrão) — compatível com MySQL/PostgreSQL via `.env`
- Tailwind CSS (CDN)
- PHPUnit

## Instalação

> Pré-requisitos: PHP 8.3+, Composer, Git.

```bash
# 1. Clonar o repositório
git clone <url-do-seu-repositorio>
cd biblioteca-ifsp

# 2. Instalar dependências PHP
composer install

# 3. Configurar o ambiente
cp .env.example .env
php artisan key:generate

# 4. Banco de dados (SQLite por padrão)
touch database/database.sqlite
# Verifique no .env: DB_CONNECTION=sqlite

# 5. Rodar migrations + seeders
php artisan migrate --seed

# 6. Subir a aplicação
php artisan serve
```

Acesse em `http://localhost:8000`.

## Usuários de teste

Criados automaticamente pelo `DatabaseSeeder` (senha igual para todos, apenas para fins de avaliação):

| Perfil         | E-mail                      | Senha      |
|----------------|------------------------------|------------|
| Administrador  | admin@biblioteca.test         | password   |
| Bibliotecário  | bibliotecaria@biblioteca.test | password   |
| Leitor         | leitor@biblioteca.test        | password   |

## Estrutura do projeto

```
Projeto/
├── README.md
├── RELATORIO.md
├── PLANO_IMPLEMENTACAO.md
├── .ai/skills/            # Skills do Laravel Boost (Identidade Visual, CRUD, Segurança, Testes)
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
└── tests/
```

## Testes automatizados

```bash
php artisan test
```

Cobrem o fluxo principal de empréstimo/devolução e o bloqueio de acesso para usuários sem permissão.
