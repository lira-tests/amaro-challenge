<?php

namespace Challenge\Controller;

use Challenge\Model\Orders;
use Challenge\Model\Products;
use Phalcon\Exception;

class IndexController extends ControllerBase
{

    /**
     * Home of API
     *
     * @return array
     */
    public function index()
    {
        return [
            'status' => 'Bem vindo!'
        ];
    }

    /**
     * Get products
     * @return array
     */
    public function products()
    {
        $products = Products::getAll();

        return [
          'products' => $products
        ];
    }

    /**
     * Return one product
     *
     * @param $productId
     * @return array
     */
    public function getProduct($productId)
    {
        $product = Products::getById($productId);

        return [
            'product' => $product
        ];
    }

    /**
     * Create a new product
     *
     * @return array
     */
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

    /**
     * Update a product
     *
     * @param $productId
     * @return array
     */
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
            if ($product = $products->updateProduct($productId, $data)) {
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

    /**
     * @param null $order_id
     * @return array
     */
    public function orders($order_id = null)
    {
        $status = $this->request->get('status', null);

        $orders = Orders::getOrders($order_id, $status);

        return [
            'orders' => $orders
        ];
    }

    public function orderItems($orderId)
    {
        $order = Orders::getOrderProducts($orderId);

        return [
            'order' => [
                'products' => $order
            ]
        ];
    }

    public function createOrder()
    {
        $data = json_decode($this->request->getRawBody(), true);

        if (json_last_error() != JSON_ERROR_NONE) {
            $this->response->setStatusCode(400);
            return [
                'Formato de JSON inválido!'
            ];
        }

        $orders = new Orders();

        try {
            if ($order = $orders->createOrder($data)) {
                $success = true;
                $message = sprintf('Order #%d criada com sucesso', $order);
            } else {
                var_dump($order);
                $success = false;
                $message = join(', ', $orders->getMessages());
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

}

