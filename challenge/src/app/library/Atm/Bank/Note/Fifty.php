<?php

namespace Challenge\Library\Atm\Bank\Note;

use Challenge\Library\Atm\Bank\Note\Constants\Amount;
use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class Fifty
 * @package Challenge\Library\Atm\Bank\Note
 */
class Fifty extends NoteAbstract
{
    /**
     * @return mixed
     */
    function getLabel()
    {
        return Label::FIFTY;
    }

    /**
     * @return float
     */
    function getValue()
    {
        return Amount::FIFTY;
    }

}