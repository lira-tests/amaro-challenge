<?php

namespace Challenge\Library;

use Challenge\Library\Atm\Charge;

/**
 * Class Atm
 * @package Challenge\Library
 */
class Atm
{
    /**
     * @var Charge
     */
    protected $atmCharge;

    /**
     * Atm constructor.
     * @param Charge $atmCharge
     */
    public function __construct(Charge $atmCharge)
    {
        $this->atmCharge = $atmCharge;
    }

    public function cashOut(int $amount)
    {

    }

    /**
     * @param int $amount
     * @return bool
     */
    protected function validate(int $amount) : bool
    {
        if (!$this->canRealizeCashOut($amount)) {
            return false;
        }

        if ($amount > $this->atmCharge->getTotalAtmAmount()) {
            return false;
        }

        return true;
    }

    /**
     * @param int $amount
     * @return bool
     */
    protected function canRealizeCashOut(int $amount) : bool
    {
        foreach ($this->atmCharge->getAvailableNotes() as $note) {
            if ($amount % $note) {
                return true;
            }
        }

        return false;
    }

}