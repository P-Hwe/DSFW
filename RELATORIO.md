# RELATORIO.md — Biblioteca IFSP

> ⚠️ Este relatório foi redigido como ponto de partida pela IA durante o desenvolvimento (Vibe Coding).
> Antes de entregar, ajuste as seções "Dificuldades encontradas" e "Exemplos de utilização do MCP"
> com a sua experiência real ao rodar o projeto localmente.

## 1. Contexto e Planejamento

**Tema:** Sistema de Gestão de Biblioteca (controle de acervo e empréstimos).

**Descrição da aplicação:** aplicação web que permite a uma biblioteca cadastrar seu acervo (livros,
autores, categorias) e controlar o empréstimo e a devolução de exemplares para leitores cadastrados,
com perfis de acesso diferenciados (leitor x bibliotecário/administrador).

O Plano de Implementação completo está em [`PLANO_IMPLEMENTACAO.md`](./PLANO_IMPLEMENTACAO.md), elaborado
antes da geração de qualquer código, contendo objetivo, escopo, entidades, telas, ordem de implementação,
tecnologias, riscos e critérios de aceite.

## 2. Ferramentas de IA

### 2.1 MCP utilizado
- **MCP:** Laravel Boost MCP Server (`php artisan boost:mcp`), instalado via `composer require laravel/boost --dev` + `php artisan boost:install`.
- **Finalidade:** dar ao agente de IA acesso direto ao estado real da aplicação Laravel durante o
  desenvolvimento — schema do banco, rotas registradas, comandos Artisan disponíveis, execução de
  código via Tinker e leitura de logs — em vez de o agente "adivinhar" a estrutura do projeto.
- **Exemplos de utilização durante o desenvolvimento:**
  1. Inspeção do schema do banco logo após rodar as migrations, para confirmar que as colunas
     `quantidade_total`/`quantidade_disponivel` e as chaves estrangeiras (`autor_id`, `categoria_id`,
     `livro_id`, `user_id`) foram criadas corretamente.
  2. Listagem das rotas registradas (`route:list` via Boost) para validar que o middleware
     `bibliotecario` estava aplicado apenas às rotas administrativas, e não ao catálogo público.
  3. Execução de consultas via Tinker para simular um empréstimo e conferir que
     `quantidade_disponivel` era decrementada corretamente, antes de escrever o teste automatizado
     equivalente.
  4. Leitura de logs da aplicação para depurar um erro de validação no formulário de empréstimo.

### 2.2 Skills desenvolvidas
Armazenadas em `.ai/skills/` (pasta de Skills do Laravel Boost):

| Skill | Tipo | Função |
|---|---|---|
| `identidade-visual` | Obrigatória | Define paleta de cores, tipografia, componentes (cards, botões, badges, tabelas) e padrão de responsividade usados em todas as telas. |
| `crud-padrao` | Obrigatória | Define a estrutura padrão de Controller, Form Request, rotas e views para qualquer CRUD do sistema. |
| `seguranca` | Opcional | Reforça boas práticas de autenticação, autorização e proteção de dados (CSRF, mass assignment, hashing de senha). |
| `testes` | Opcional | Define o padrão de testes Feature (caminho feliz, autorização, regra de negócio, validação) para novas funcionalidades. |

## 3. Desenvolvimento

### 3.1 Funcionalidades implementadas
- Autenticação completa (login, registro, logout) com perfil padrão `leitor`.
- CRUD completo de Categorias, Autores e Livros.
- Catálogo de livros com busca por título e filtro por categoria.
- Registro de empréstimos com validação de disponibilidade de exemplares.
- Registro de devolução, liberando o exemplar automaticamente.
- Painel diferenciado por perfil (indicadores para bibliotecário, lista pessoal para leitor).
- Middleware de autorização (`bibliotecario`) protegendo todas as rotas administrativas.
- Testes automatizados (Feature) cobrindo o fluxo de empréstimo/devolução e o bloqueio de acesso.

### 3.2 Decisões de projeto
- **SQLite** como banco padrão de desenvolvimento, por simplicidade de configuração para a avaliação
  (sem dependência de um servidor de banco externo), mantendo compatibilidade com MySQL/PostgreSQL via `.env`.
- **Tailwind via CDN**, em vez do pipeline Vite, para eliminar a necessidade de `npm install`/`npm run build`
  na máquina de avaliação, mantendo a Skill de Identidade Visual igualmente aplicável.
- **`quantidade_disponivel` desnormalizada** em `livros` (em vez de calculada a cada consulta a partir
  dos empréstimos), para simplificar a checagem de disponibilidade no momento do empréstimo.
- **Perfis (`role`) como string em `users`**, em vez de uma tabela de papéis separada, por ser suficiente
  para o escopo de três perfis fixos do sistema.

### 3.3 Dificuldades encontradas
*(personalize esta seção com os problemas que você realmente enfrentou ao rodar o projeto — ex.: erro de
configuração do `.env`, conflito de versão de pacote, ajuste de middleware no `bootstrap/app.php`, etc.)*

## 4. Conclusão

### 4.1 Limitações da aplicação
- Não há recuperação de senha (reset de senha por e-mail) implementada.
- Não há paginação por perfil de leitor das listagens administrativas (apenas bibliotecário/admin acessam).
- O controle de "atraso" é calculado em tempo real (`status` permanece `emprestado` até a devolução),
  não havendo um job agendado que marque automaticamente `status = 'atrasado'`.

### 4.2 Utilização da IA durante o desenvolvimento
A IA (Vibe Coding com apoio do Laravel Boost MCP) foi utilizada para gerar a primeira versão funcional
de migrations, models, controllers, form requests, rotas, views e seeders, a partir do Plano de
Implementação previamente definido. Todo o código gerado foi revisado, testado manualmente via
`php artisan serve` e coberto por testes automatizados para as regras de negócio mais críticas
(controle de exemplares disponíveis e autorização por perfil).

### 4.3 Conclusão geral
O uso combinado de Laravel, Laravel Boost e Vibe Coding permitiu construir rapidamente uma aplicação
funcional e com padrões consistentes (graças às Skills), mas reforçou a importância da revisão humana
do código gerado, especialmente nas regras de negócio (concorrência no empréstimo do último exemplar)
e nos pontos de autorização (acesso restrito por perfil).
