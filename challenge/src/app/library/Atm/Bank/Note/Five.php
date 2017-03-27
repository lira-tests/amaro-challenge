<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class Five
 * @package Challenge\Library\Atm\Bank\Note
 */
class Five extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::FIVE;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::FIVE;
    }

}