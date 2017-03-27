<?php

namespace Challenge\Library\Atm\Bank;

/**
 * Class NoteAbstract
 * @package Challenge\Library\Atm\Bank
 */
abstract class NoteAbstract implements NoteInterface
{
    /**
     * @var integer
     */
    protected $quantity = 0;

    /**
     * @return integer
     */
    function getQuantity() : int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Decrement quantity
     * @param int $quantity
     */
    public function decrement(int $quantity)
    {
        $this->quantity -= $quantity;
    }

    /**
     * @return mixed
     */
    function getAmount()
    {
        return $this->getQuantity() * $this->getValue();
    }


}