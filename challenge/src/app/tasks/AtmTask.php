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

        $charge = new Atm\Charge();
        foreach (Atm::getAvailableNotes() as $notes) {
            $class = 'Challenge\\Library\\Atm\\Bank\\Note\\' . ucfirst($notes);
            $initNote = new $class();
            $initNote->setQuantity(rand(0,100));
            $charge->add($initNote);
        }

        $atm = new Atm($charge);

        do {
            echo '====================' . PHP_EOL;
            echo '=       AÇÕES      =' . PHP_EOL;
            echo '====================' . PHP_EOL;
            echo PHP_EOL;
            echo '(1) Saque' . PHP_EOL;
            echo '(2) Notas disponíveis' . PHP_EOL;
            echo '(3) Encerrar' . PHP_EOL;
            echo sprintf('Total disponível R$ %d,00', $atm->getTotalAmount());
            echo PHP_EOL;

            $operations = trim(fgets(STDIN));

            switch ($operations) {
                case 1:
                    echo '====================' . PHP_EOL;
                    echo '=       SAQUE      =' . PHP_EOL;
                    echo '====================' . PHP_EOL;
                    echo 'Qual o valor do saque? R$ ';
                    $cashAmount = (int) str_replace(',','.', trim(fgets(STDIN)));
                    echo '====================' . PHP_EOL;
                    echo '=      ENTREGA     =' . PHP_EOL;
                    echo '====================' . PHP_EOL;
                    print_r(implode(PHP_EOL, $atm->cashOut($cashAmount)));
                    echo PHP_EOL;
                    echo '====================' . PHP_EOL;
                    break;
                case 2:
                    echo '====================' . PHP_EOL;
                    echo '=    QUANTIDADE    =' . PHP_EOL;
                    echo '====================' . PHP_EOL;
                    print_r(implode(PHP_EOL, $atm->getAvailableNotesQuantity()));
                    echo PHP_EOL;
                    echo sprintf('Total disponível R$ %d,00', $atm->getTotalAmount());
                    echo PHP_EOL;
                    echo '====================' . PHP_EOL;
                    break;
                case 3:
                    break 2;
            }

        } while(true);

    }

    /**
     * @param array $params
     */
    public function testAction(array $params)
    {
        $amount = $params[0];
        $charge = new Atm\Charge();
        foreach (Atm::getAvailableNotes() as $notes) {
            $class = 'Challenge\\Library\\Atm\\Bank\\Note\\' . ucfirst($notes);
            $initNote = new $class();
            $initNote->setQuantity(5);
            $charge->add($initNote);
        }

        $atm = new Atm($charge);

        echo '====================' . PHP_EOL;
        echo '=      ENTREGA     =' . PHP_EOL;
        echo '====================' . PHP_EOL;
        print_r(implode(PHP_EOL, $atm->cashOut($amount)));
        echo PHP_EOL;
    }
}