<?php

namespace Challenge\Controller;

use Challenge\Model\Orders;
use Challenge\Model\Products;

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
        $products = Products::find();

        return [
          'products' => $products
        ];
    }

    public function getProduct($productId)
    {
        $product = Products::findFirst($productId);
        $variants = $product->variants;
        $product = $product->toArray();

        $product['variants'] = $variants;

        return [
            'product' => $product
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

