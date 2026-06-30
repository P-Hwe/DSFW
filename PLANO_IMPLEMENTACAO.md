# Plano de Implementação — Sistema de Gestão de Biblioteca (Empréstimos)

## 1. Contexto

### 1.1 Objetivo da aplicação
Disponibilizar um sistema web para uma biblioteca (escolar/comunitária) gerenciar seu acervo de
livros e controlar o ciclo de empréstimo e devolução de exemplares para os leitores cadastrados.

### 1.2 Problema que resolve
Bibliotecas pequenas frequentemente controlam empréstimos em planilhas ou cadernos, o que dificulta
saber quantos exemplares de um livro estão disponíveis no momento, quais empréstimos estão atrasados
e o histórico de cada leitor. O sistema centraliza essas informações, evitando empréstimos de livros
sem exemplar disponível e dando visibilidade sobre atrasos.

### 1.3 Público-alvo
- **Leitores**: consultam o catálogo e acompanham seus próprios empréstimos.
- **Bibliotecários**: administram o acervo (livros, autores, categorias) e o fluxo de empréstimo/devolução.
- **Administrador**: mesmas permissões de bibliotecário, perfil reservado para gestão geral do sistema.

## 2. Escopo

### 2.1 Funcionalidades
- Cadastro/login/logout de usuários (perfil padrão: leitor).
- CRUD de Categorias.
- CRUD de Autores.
- CRUD de Livros (com autor, categoria, ISBN, quantidade de exemplares).
- Catálogo público (para usuários autenticados) com busca por título e filtro por categoria.
- Registro de Empréstimo (vincula livro + leitor + bibliotecário responsável + datas).
- Registro de Devolução (atualiza status e libera exemplar).
- Painel (dashboard) com indicadores para bibliotecário e lista de empréstimos para o leitor.
- Controle de acesso por perfil (`leitor` x `bibliotecario`/`admin`).

### 2.2 Entidades do banco de dados
- `users` (nativa do Laravel + coluna `role`)
- `categorias` (id, nome, descricao)
- `autores` (id, nome, nacionalidade, biografia)
- `livros` (id, titulo, isbn, ano_publicacao, quantidade_total, quantidade_disponivel, autor_id, categoria_id)
- `emprestimos` (id, livro_id, user_id, responsavel_id, data_emprestimo, data_prevista_devolucao, data_devolucao, status)

### 2.3 Telas
1. Login / Registro
2. Dashboard (painel do bibliotecário ou lista de empréstimos do leitor)
3. Listagem/CRUD de Categorias
4. Listagem/CRUD de Autores
5. Listagem/CRUD de Livros + página de detalhes do livro
6. Listagem/criação de Empréstimos + página de detalhes + ação de devolução

### 2.4 Ordem de implementação
1. Instalação do Laravel + Laravel Boost
2. Criação das Skills (Identidade Visual, CRUD, Segurança, Testes)
3. Elaboração deste Plano de Implementação
4. Modelagem do banco (migrations)
5. Models e relacionamentos Eloquent
6. Autenticação (login/registro/logout) e controle de acesso por perfil
7. Form Requests de validação
8. Controllers e rotas dos CRUDs (Categorias → Autores → Livros → Empréstimos)
9. Views Blade seguindo a Skill de Identidade Visual
10. Seeders com usuários de teste e dados de exemplo
11. Testes automatizados das regras de negócio principais
12. Documentação final (README e RELATORIO.md)

## 3. Técnico

### 3.1 Tecnologias utilizadas
- PHP 8.3 / Laravel (versão instalada via `composer create-project laravel/laravel`)
- Laravel Boost (MCP + Skills)
- Banco de dados: SQLite (desenvolvimento/avaliação) — compatível com MySQL/PostgreSQL via `.env`
- Tailwind CSS (via CDN, sem build step)
- PHPUnit para testes automatizados
- Git/GitHub para versionamento

### 3.2 Riscos
- **Concorrência no controle de exemplares**: dois empréstimos simultâneos do último exemplar disponível.
  Mitigação: verificação de `quantidade_disponivel > 0` no momento do `store()`, decremento atômico via `decrement()`.
- **Exclusão de registros com dependências** (categoria com livros, livro com empréstimo aberto).
  Mitigação: validação explícita no Controller antes de qualquer `delete()`.
- **Mudança de papel (role) indevida**: usuário comum tentando se autopromover a bibliotecário.
  Mitigação: registro público sempre força `role = 'leitor'`; alteração de papel só via seeder/admin.

### 3.3 Critérios de aceite
- [ ] Login e registro funcionando, com usuários de teste cadastrados via Seeder.
- [ ] CRUD completo de Categorias, Autores e Livros, restrito a bibliotecário/admin.
- [ ] Catálogo de livros visível para qualquer usuário autenticado, com busca e filtro.
- [ ] Registro de empréstimo decrementa `quantidade_disponivel` e bloqueia se não houver exemplar.
- [ ] Registro de devolução incrementa `quantidade_disponivel` e atualiza o status.
- [ ] Leitor não consegue acessar rotas administrativas (retorno 403).
- [ ] Layout consistente entre todas as telas, seguindo a Skill de Identidade Visual.
- [ ] Pelo menos um MCP documentado em uso (Laravel Boost MCP).
