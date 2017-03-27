<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class Ten
 * @package Challenge\Library\Atm\Bank\Note
 */
class Ten extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::TEN;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::TEN;
    }

}