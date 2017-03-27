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
    const REGEX_EXPLODE_COMMA = '/%s+/';

    /**
     * Default explode by comma
     */
    const EXPLODE_BY_DEFAULT = ',';

    /**
     * @param string $str
     * @param string $explodeBy
     * @return array
     */
    public static function string2Array(string $str, string $explodeBy = Stringer::EXPLODE_BY_DEFAULT) : array
    {
        return preg_split(
            Stringer::getRegexPattern($explodeBy),
            $str
        );
    }

    /**
     * @param string $explodeBy
     * @return string
     */
    protected static function getRegexPattern(string $explodeBy)
    {
        return sprintf(
            Stringer::REGEX_EXPLODE_COMMA,
            $explodeBy
        );
    }
}