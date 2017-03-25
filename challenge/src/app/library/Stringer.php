<?php

namespace Challenge\Library;

/**
 * Class Stringer
 * @package Challenge\Library
 */
class Stringer
{
    /**
     * Default regex explode pattern
     */
    const REGEX_EXPLODE_COMMA = '/,+/';

    /**
     * @param string $str
     * @param string $pattern
     * @return array
     */
    public static function string2Array(string $str, string $pattern = Stringer::REGEX_EXPLODE_COMMA) : array
    {
        return preg_split(
            $pattern,
            $str
        );
    }
}