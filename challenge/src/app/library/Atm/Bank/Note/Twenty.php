<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class Twenty
 * @package Challenge\Library\Atm\Bank\Note
 */
class Twenty extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::TWENTY;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::TWENTY;
    }

}