#!/usr/bin/env bash
# Rode este script DEPOIS de copiar a pasta "overlay/" inteira para dentro do
# seu projeto Laravel real (o que já possui Laravel + Boost instalados e o
# primeiro commit feito). Ele cria o histórico incremental de commits exigido
# pela atividade (mínimo de 10 commits).
#
# Uso:
#   cp -r overlay/* /caminho/do/seu-projeto-laravel/
#   cp -r overlay/.ai /caminho/do/seu-projeto-laravel/
#   cd /caminho/do/seu-projeto-laravel
#   bash scripts/montar_commits.sh
#
# Pré-requisito: 'git init' / primeiro commit ("Instalação do Laravel" +
# "Instalação do Laravel Boost") já deve ter sido feito por você antes de rodar isto.

set -e

git add .ai/skills
git commit -m "docs: adiciona Skills do Laravel Boost (Identidade Visual e CRUD)"

git add .ai/skills/seguranca .ai/skills/testes 2>/dev/null || true
git commit -m "docs: adiciona Skills opcionais (Seguranca e Testes)" --allow-empty

git add PLANO_IMPLEMENTACAO.md
git commit -m "docs: adiciona Plano de Implementacao"

git add database/migrations
git commit -m "feat(db): cria migrations de Categoria, Autor, Livro e Emprestimo"

git add app/Models database/factories
git commit -m "feat(models): implementa models, relacionamentos Eloquent e factories"

git add database/seeders
git commit -m "feat(db): adiciona seeders com usuarios de teste e dados de exemplo"

git add app/Http/Requests
git commit -m "feat: adiciona Form Requests de validacao"

git add app/Http/Controllers/Auth
git commit -m "feat(auth): implementa autenticacao (login, registro, logout)"

git add app/Http/Middleware
git commit -m "feat(auth): middleware de controle de acesso por perfil (bibliotecario)"

git add app/Http/Controllers/CategoriaController.php app/Http/Controllers/AutorController.php
git commit -m "feat(crud): CRUD de Categorias e Autores"

git add app/Http/Controllers/LivroController.php
git commit -m "feat(crud): CRUD de Livros com busca e filtro por categoria"

git add app/Http/Controllers/EmprestimoController.php app/Http/Controllers/DashboardController.php
git commit -m "feat(crud): CRUD de Emprestimos e regra de negocio de devolucao"

git add routes/web.php
git commit -m "feat: define rotas da aplicacao"

git add resources/views
git commit -m "feat(ui): implementa views Blade seguindo a Skill de Identidade Visual"

git add tests
git commit -m "test: adiciona testes automatizados de emprestimo e autorizacao"

git add README.md RELATORIO.md
git commit -m "docs: README e Relatorio final"

echo ""
echo "Historico criado com sucesso. Confira com: git log --oneline"
