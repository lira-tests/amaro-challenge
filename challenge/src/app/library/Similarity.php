<?php

namespace Challenge\Library;

/**
 * Class Similarity
 * @package Challenge\Library
 */
class Similarity
{
    /**
     * Number Euler
     * @see https://pt.wikipedia.org/wiki/N%C3%BAmero_de_Euler
     */
    const EULER = 2.718281828459045235360287471352662497757;

    /**
     * @param int $tags
     * @param int $categories
     * @return float
     */
    public static function calculate(int $tags, int $categories) : float
    {
        return round((
                0.3 *
                    ( 1 /
                        (
                            1 +
                            pow(Similarity::EULER, (5 - $tags))
                        )
                    )
            )
            +
            (
                0.7 *
                    ( 1 /
                        (
                            1 +
                            pow(Similarity::EULER, (1 - $categories))
                        )
                    )
            ), 1);
    }

}