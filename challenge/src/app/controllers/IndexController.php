<?php

namespace Challenge\Controller;

use Challenge\Model\Orders;
use Challenge\Model\Products;
use Phalcon\Exception;

class IndexController extends ControllerBase
{

    public function index()
    {
        return [
            'status' => 'Bem vindo!'
        ];
    }

    public function products()
    {
        $products = Products::getAll();

        return [
          'products' => $products
        ];
    }

    public function getProduct($productId)
    {
        $product = Products::getById($productId);

        return [
            'product' => $product
        ];
    }

    public function createProduct()
    {
        $data = json_decode($this->request->getRawBody(), true);

        if (json_last_error() != JSON_ERROR_NONE) {
            $this->response->setStatusCode(400);
            return [
                'Formato de JSON inválido!'
            ];
        }

        $products = new Products();

        try {
            if ($produto = $products->createProduct($data)) {
                $success = true;
                $message = 'Produto salvo com sucesso!';
            } else {
                $success = false;
                $message = join(', ', $products->getMessages());
            }
        } catch (Exception $exception) {
            $success = false;
            $message = $exception->getMessage();
        }

        return [
            'sucesso' => $success,
            'mensagem' => $message
        ];
    }

    public function updateProduct($productId)
    {
        $data = json_decode($this->request->getRawBody(), true);

        if (json_last_error() != JSON_ERROR_NONE) {
            $this->response->setStatusCode(400);
            return [
                'Formato de JSON inválido!'
            ];
        }

        $products = new Products();

        try {
            if ($produto = $products->updateProduct($productId, $data)) {
                $success = true;
                $message = sprintf('Produto #%d atualizado com sucesso!', $productId);
            } else {
                $success = false;
                $message = join(', ', $products->getMessages());
            }
        } catch (Exception $exception) {
            $success = false;
            $message = $exception->getMessage();
        }

        return [
            'sucesso' => $success,
            'mensagem' => $message
        ];
    }

    public function orders()
    {
        $orders = Orders::find();

        return [
            'orders' => $orders
        ];
    }

}

