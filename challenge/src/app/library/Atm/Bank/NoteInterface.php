<?php

namespace Challenge\Library\Atm\Bank;

/**
 * Interface NoteInterface
 * @package Challenge\Library\Atm\Bank
 */
interface NoteInterface
{
    /**
     * @return string
     */
    function getLabel();

    /**
     * @return float
     */
    function getValue();

    /**
     * @return integer
     */
    function getQuantity();
}