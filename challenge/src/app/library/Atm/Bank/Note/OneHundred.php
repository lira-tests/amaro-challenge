<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class OneHundred
 * @package Challenge\Library\Atm\Bank\Note
 */
class OneHundred extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::ONE_HUNDRED;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::ONE_HUNDRED;
    }

}