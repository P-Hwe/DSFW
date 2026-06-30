---
name: testes
description: Use ao escrever ou revisar testes automatizados (Feature/Unit) para as funcionalidades do sistema, garantindo cobertura das regras de negócio principais.
---

# Skill: Testes Automatizados — Biblioteca IFSP

## Stack
- PHPUnit (padrão do `laravel/laravel`), com `RefreshDatabase` para isolar cada teste em um banco limpo (SQLite em memória recomendado em `phpunit.xml`).
- Testes ficam em `tests/Feature` (fluxos HTTP completos) e `tests/Unit` (regras isoladas de Model, quando aplicável).

## O que sempre testar em um novo CRUD/feature
1. **Caminho feliz**: usuário autorizado consegue executar a ação esperada (ex.: bibliotecário registra um empréstimo).
2. **Autorização**: usuário sem permissão recebe `403` (ex.: leitor tentando registrar empréstimo).
3. **Regra de negócio crítica**: efeitos colaterais importantes são verificados no banco (ex.: `quantidade_disponivel` decrementada ao emprestar, incrementada ao devolver).
4. **Validação**: dados inválidos retornam erros de validação (`assertSessionHasErrors`) e não persistem no banco.

## Padrão de escrita
- Nome do método de teste descreve o comportamento em português: `test_bibliotecario_pode_registrar_emprestimo`.
- Usar Factories (`database/factories`) para criar dados de apoio, nunca inserir registros manualmente com `DB::table()->insert()`.
- Usar `actingAs($usuario)` para simular o usuário autenticado, evitando lidar com sessão/login manualmente.
- Asserções específicas (`assertDatabaseHas`, `assertEquals`) em vez de apenas checar o status HTTP, quando o teste envolve regra de negócio.

## Rodando os testes
```
php artisan test
```
ou
```
./vendor/bin/phpunit
```

Sempre que uma nova regra de negócio for implementada (ex.: bloquear empréstimo sem exemplares disponíveis), adicione um teste cobrindo esse cenário.
