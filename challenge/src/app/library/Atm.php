<?php

namespace Challenge\Library;

use Challenge\Library\Atm\Bank\Note\Constants\Label;
use Challenge\Library\Atm\Bank\NoteAbstract;
use Challenge\Library\Atm\Charge;

/**
 * Class Atm
 * @package Challenge\Library
 */
class Atm
{
    /**
     * @var array
     */
    protected static $availableNotes = [
        Label::ONE_HUNDRED,
        Label::FIFTY,
        Label::TWENTY,
        Label::TEN,
        Label::FIVE,
        Label::TWO,
        Label::ONE,
    ];

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

    /**
     * @return array
     */
    public static function getAvailableNotes(): array
    {
        return self::$availableNotes;
    }

    /**
     * @param int $amount
     * @return array
     */
    public function cashOut(int $amount)
    {
        /**
         * Check this amount is possible to get
         */
        if ($this->validate($amount)) {
            return $this->getCash($amount);
        }

        return [
            'response' => false,
            'data' => 'Não foi possível realizar o saque!'
        ];
    }

    /**
     * @return array
     */
    public function getAvailableNotesQuantity(): array
    {
        $response = [];

        /** @var NoteAbstract $note */
        foreach ($this->atmCharge->getAvailableNotes() as $note) {
            $response[] = sprintf(
                '%d nota(s) de R$%d,00 disponíveis',
                $note->getQuantity(),
                $note->getValue()
            );
        }

        return $response;
    }

    /**
     * @return int
     */
    public function getTotalAmount() :int
    {
        return $this->atmCharge->getTotalAtmAmount();
    }

    /**
     * @param int $amount
     * @return array
     */
    protected function getCash(int $amount) : array
    {
        $notes = [];
        $quantity = 0;
        $rest = 0;

        /** @var NoteAbstract $note */
        foreach($this->atmCharge->getAvailableNotes() as $note) {
            $rest = $amount % $note->getValue();
            $amount = $amount - $rest;
            $quantity = $amount / $note->getValue();

            /**
             * Verify quantity of the notes
             */
            if ($quantity > $note->getQuantity()) {
                /**
                 * Sum rest with no possible quantity
                 */
                $rest += ($note->getValue() * ($quantity - $note->getQuantity()));
                $quantity = $note->getQuantity();
            }

            if ($quantity) {
                $notes[$note->getValue()] = $quantity;
                $note->decrement($quantity);
            }

            $amount = $rest;
        }

        $response = [];

        foreach ($notes as $val => $qty) {
            $response[] = sprintf(
                '%d nota(s) R$%d,00',
                $qty,
                $val
            );
        }

        return $response;
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
        /** @var NoteAbstract $note */
        foreach ($this->atmCharge->getAvailableNotes() as $note) {
            if ($amount % $note->getValue() == 0) {
                return true;
            }
        }

        return false;
    }

}