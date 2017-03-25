<?php

namespace Challenge\Library\Atm\Bank;

/**
 * Class NoteAbstract
 * @package Challenge\Library\Atm\Bank
 */
abstract class NoteAbstract implements NoteInterface
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var integer
     */
    protected $quantity;
}