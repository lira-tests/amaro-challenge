<?php

namespace Challenge\Tasks;

use Challenge\Library\Atm;
use function Couchbase\defaultDecoder;
use Phalcon\Cli\Task;
use Phalcon\Mvc\View\Engine\Php;

/**
 * Class AtmTask
 * @package Challenge\Tasks
 */
class AtmTask extends Task
{
    public function mainAction()
    {
        echo 'Iniciando o Caixa Eletrônico...' . PHP_EOL;
        echo PHP_EOL;
        echo ' ---------------------------------------------- ' . PHP_EOL;
        echo '|    Informe a disponibilidade de casa nota    |' . PHP_EOL;
        echo ' ---------------------------------------------- ' . PHP_EOL;

        $notas = [
            'R$ 100',
            'R$ 50',
            'R$ 20',
            'R$ 10',
            'R$ 5',
            'R$ 2',
            'R$ 1',
        ];

        $quantidade = [];

//        foreach ($notas as $nota) {
//            echo 'Quantas notas de ' . $nota . '? ';
//            $val = trim(fgets(STDIN));
//            if (!is_numeric($val)) {
//                $val = 0;
//            }
//            $quantidade[md5($nota)] = $val;
//        }

        do {
            echo 'Qual operação quer realizar? ' . PHP_EOL;
            echo '(1) Saque' . PHP_EOL;
            echo '(2) Notas disponíveis' . PHP_EOL;
            echo '(3) Encerrar' . PHP_EOL;

            $operacao = trim(fgets(STDIN));

            switch ($operacao) {
                case 1:
                    echo 'Qual o valor do saque? R$ ';
                    $saque = (float) str_replace(',','.', trim(fgets(STDIN)));
                    echo PHP_EOL . $saque . PHP_EOL;
                    break;
                case 2:
                    break 2;
            }

        } while(true);

    }
}