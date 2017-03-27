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

```php -S localhost:8000 -t public/ .htrouter.php```