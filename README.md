<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Cart Service - Sistema de E-commerce com Microsserviços

Este microsserviço é responsável por **gerenciar o carrinho de compras** dos usuários no sistema de e-commerce distribuído. Ele permite adicionar, listar, remover e limpar itens do carrinho, e é acessado via API Gateway.

## Funcionalidades

-  Adicionar produtos ao carrinho
-  Listar itens com dados completos (via consulta ao catalog-service)
-  Contar itens totais no carrinho
-  Remover item específico
-  Limpar o carrinho por completo

## Integração com outros microsserviços

| Serviço Integrado     | Função                                                                 |
|------------------------|------------------------------------------------------------------------|
| **auth-service**       | Valida e identifica o usuário logado                                   |
| **catalog-service**    | Retorna detalhes dos produtos adicionados ao carrinho                  |
| **gateway**            | Todas as requisições são encaminhadas através dele (`APP_GATEWAY`)     |

## Tecnologias Utilizadas

- PHP 8.2+
- Laravel 11
- Laravel HTTP Client
- Eloquent ORM

## Estrutura de Requisições

### Adicionar item ao carrinho

**POST** `/api/service/cart/cart`

```json
{
  "product_id": 1,
  "quantity": 2
}
