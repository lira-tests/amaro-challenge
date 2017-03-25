<?php

namespace Challenge\Controller;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        return [
            'status' => 'Bem vindo!'
        ];
    }

}

