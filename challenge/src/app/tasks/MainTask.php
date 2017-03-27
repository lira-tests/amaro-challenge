<?php

namespace Challenge\Tasks;

use Challenge\Model\Products;
use Phalcon\Cli\Task;
use Phalcon\Exception;

class MainTask extends Task
{
    /**
     * Task to update products similar
     */
    public function mainAction()
    {
        echo 'Atualizando a base de similares...' . PHP_EOL;

        $response = '';

        try {
            Products::updateSimilar();
            $response = 'Atualizando com sucesso!';
        } catch (Exception $e) {
            $response = sprintf(
                'Não foi atualizado com sucesso, erro: %s',
                $e->getMessage()
            );
        }

        echo $response;
    }
}