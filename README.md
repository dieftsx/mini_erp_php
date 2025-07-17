# Mini ERP PHP - Controle de Pedidos, Produtos e Estoque

Este projeto é um mini sistema ERP desenvolvido em PHP puro com banco de dados MySQL. Ele oferece funcionalidades essenciais de controle de pedidos, produtos, cupons e estoque.

## Funcionalidades

- Cadastro e edição de produtos com variações e estoque
- Carrinho de compras com cálculo de frete
- Aplicação e verificação de cupons de desconto
- Consulta automática de endereço via CEP (ViaCEP)
- Finalização de pedido com envio de e-mail
- Webhook para atualização ou cancelamento de pedidos
- Relatórios com histórico de pedidos

## Tecnologias

- PHP Puro (MVC)
- MySQL
- Bootstrap (recomendado para layout)
- JavaScript (AJAX para ViaCEP)
- Sessões para controle do carrinho

## Como usar

1. Clone o repositório
2. Crie o banco de dados MySQL com as tabelas `produtos`, `estoque`, `pedidos`, `cupons`
3. Atualize as credenciais de conexão no arquivo `config/db.php`
4. Acesse `index.php` no navegador

## Estrutura de diretórios

```
├── config/
├── controllers/
├── models/
├── views/
├── webhook.php
└── index.php
```

## Webhook

O endpoint `webhook.php` aceita JSON com os campos:

```json
{
  "id": 1,
  "status": "cancelado"
}
```

## Frete

- Subtotal entre R$52,00 e R$166,59 → Frete R$15,00  
- Subtotal > R$200,00 → Frete grátis  
- Outros casos → Frete R$20,00

---

