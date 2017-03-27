<?php

namespace Challenge\Library\Atm;

use Challenge\Library\Atm\Bank\NoteAbstract;

/**
 * Class Charge
 * @package Challenge\Library\Atm
 */
class Charge
{
    /**
     * @var array
     */
    protected $bankNotes = [];

    /**
     * @param NoteAbstract $bankNote
     */
    public function add(NoteAbstract $bankNote)
    {
        $this->bankNotes[] = $bankNote;
    }

    /**
     * @return int
     */
    public function getTotalAtmAmount() : int
    {
        $amount = 0;

        /** @var NoteAbstract $bankNote */
        foreach ($this->getAvailableNotes() as $bankNote) {
            $amount += $bankNote->getValue() * $bankNote->getQuantity();
        }

        return $amount;
    }

    /**
     * @return array
     */
    public function getAvailableNotes()
    {
        $available = [];

        /** @var NoteAbstract $bankNote */
        foreach ($this->bankNotes as $bankNote) {
            if ($bankNote->getQuantity() > 0) {
                $available[] = $bankNote;
            }
        }

        return $available;
    }

}