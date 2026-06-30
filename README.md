# Biblioteca IFSP - Sistema de Gestao de Biblioteca e Emprestimos

Aplicacao web em Laravel para gerenciar o acervo de uma biblioteca e controlar o ciclo de
emprestimo/devolucao de livros.

## Release Inicial

- Versao: `v0.1.0`
- Stack: Laravel 13, PHP 8.3+, SQLite
- Inclui: autenticacao, controle de perfis, CRUDs principais e fluxo de emprestimos

## Execucao Rapida (Windows + PowerShell)

Pre-requisitos:

- PHP 8.3+
- Composer 2+
- Git

Passo a passo:

```powershell
git clone https://github.com/P-Hwe/DSFW.git
cd DSFW

composer install

Copy-Item .env.example .env
php artisan key:generate

if (!(Test-Path database\database.sqlite)) { New-Item -ItemType File -Path database\database.sqlite | Out-Null }

php artisan migrate --seed
php artisan serve
```

Acesse: `http://127.0.0.1:8000`

## Usuarios de teste

Criados automaticamente pelo seeder (senha para todos: `password`):

| Perfil | E-mail |
|---|---|
| Administrador | admin@biblioteca.test |
| Bibliotecario | bibliotecaria@biblioteca.test |
| Leitor | leitor@biblioteca.test |

## Comandos uteis

```bash
php artisan test
php artisan route:list
php artisan migrate:fresh --seed
```
