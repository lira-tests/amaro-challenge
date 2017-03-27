<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class One
 * @package Challenge\Library\Atm\Bank\Note
 */
class One extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::ONE;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::ONE;
    }

}