RESOLUÇÃO DO TESTE
==================

Foi usado o framework Phalcon para resolver todos os desafios.

Phalcon DevTools Version: 3.0.5

Phalcon Version: 3.1.1

## 1º TESTE - Caixa Eletrônico

Para executar entre no diretório raiz.

```php app/cli.php atm```

## 2º TESTE - Explosão de string

A explosão está em ```app\library\Stringer``` na função *string2Array*.

Foi usada a função **preg_split**, usando uma expressão regular.

Existe testes unitários para essa função.

## 3º TESTE - API

Inicialmente é preciso ter a extensão do Phalcon

### Iniciar o servidor bult-in do PHP
```
php -S localhost:8000 -t public/ .htrouter.php
```
### Instalar dependências via Composer

```
composer install
```

### Executar testes unitários

```
cd test/
../vendor/phpunit/phpunit/phpunit
```

### Endpoints

 - GET /products : lista todos os produtos
 
 retorno:
 ```
 { 
    "products": [
        {...}
    ]
 }
 ```
 
 - POST /products : cria um novo produto
 
 raw data:
 ```
 {
 	"name": "Novo produto",
     "slug": "novo-produto",
     "description": "Descricao",
     "tags": [
     	"tag1",
         "tag2"
     ],
     "categories": [
     	"cat1",
         "cat2"
     ],
     "variants": [
     	{
         	"price": "99.99",
             "price_old": null,
             "slug": "novo-produto-variant-1",
             "quantity": 199
         }
     ]
 }
 ```
 
 - PUT /products/{ID do produto} : atualiza as informações do produto com esta ID
 
 raw data:
 ```
 {
 	"name": "Novo Nome",
     "description": "Nova descrição",
     "tags": [
     	"novas tags",
         "outra nova"
     ],
     "categories": [
     	"cat 2",
         "cat 3"
     ],
     "variants": [
     	{
         	"id": 1,
         	"name": "Branco",
         	"price": "88.99",
             "price_old": null,
             "quantity": 5
         },
         
     	{
         	"id": 2,
         	"name": "Preto",
         	"price": "77.99",
             "price_old": null,
             "quantity": 9
         }
     ]
 }
 ```
 
 - GET /products/{ID do produto} : lista as informações do produto com esta ID,  - inclusive os três produtos mais similares
 
 retorno:
 ```
 {
     "product": {
         "id": "1",
         "name": "Novo produto",
         "slug": "produto",
         "tags": [
             "tags",
             ...
         ],
         "categories": [
             "cat1",
             ...
         ],
         "description": "Descrição",
         "variants": [
             {
                 "id": "1",
                 "name": "Branca",
                 "price": "15.9",
                 "price_old": null,
                 "quantity": "50"
             },
            ...
         ],
         "similars": [
             {
                 "id": "1",
                 "name": "Nome",
                 "description": "Descrição"
             },
            ...
         ]
     }
 }
 ```
 
 - GET /orders : lista todos os pedidos
 
 retorno:
 ```
 {
     "orders": [
         {
             "id": "1",
             "name": "Usuario",
             "status": "Aguardando Pagamento"
         },
         ...
 }
 ```
 
 - GET /orders/{ID do pedido} : lista as informações do pedido com esta ID
 
 retorno:
 ```
 {
     "orders": [
         {
             "id": "1",
             "name": "Usuario",
             "status": "Aguardando Pagamento"
         }
     ]
 }
 ```
 - GET /orders?status={status_code} : lista todos os pedidos com um determinado  - código de status
 
  retorno:
  ```
  {
      "orders": [
          {
              "id": "1",
              "name": "Usuario",
              "status": "Aguardando Pagamento"
          }
      ]
  }
  ```
 
 - GET /orders/{ID do pedido}/products : lista os itens do pedido com esta ID
 
 retorno:
 ```
 {
     "order": {
         "products": {
             "10": [
                 {
                     "product": {
                         "id": "2",
                         "name": "Colar Arrow",
                         "description": "A extravagância e a riqueza de detalhes dos acessórios inspira o Colar Arrow. Opção incrível para complementar looks que vão do casual ao sofisticado."
                     },
                     "variant": {
                         "id": "5",
                         "name": "Azul"
                     },
                     "image": {
                         "url": "assets/image5.jpg"
                     },
                     "quantity": "1"
                 }
             ],
            ...
         }
     }
 }
 ```
 
 - POST /orders : cria um novo pedido ; deve ser informado o ID do usuário
 
 raw data:
 ```
 {
 	"userId": 1,
     "variants": [
     	{
         	"id": 1,
             "quantity": 2
         }
     ]
 }
 ```