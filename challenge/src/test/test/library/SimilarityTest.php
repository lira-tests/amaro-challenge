<?php

namespace Test\Library;

use Challenge\Library\Similarity;

class SimilarityTest extends \UnitTestCase
{
    public function testMost()
    {
        var_dump(Similarity::calculate(0,0));
        var_dump(Similarity::calculate(3,3));
    }
}
