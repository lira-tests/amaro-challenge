<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class Two
 * @package Challenge\Library\Atm\Bank\Note
 */
class Two extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::TWO;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::TWO;
    }

}