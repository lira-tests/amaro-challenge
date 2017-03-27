<?php

namespace Test\Library;

use Challenge\Library\Similarity;

/**
 * Class SimilarityTest
 * @package Test\Library
 */
class SimilarityTest extends \UnitTestCase
{
    /**
     * When categories and tags as similar
     */
    public function testBigValue()
    {
        $this->assertEquals(1, Similarity::calculate(100,100));
    }

    /**
     * When categories and tags not similar
     */
    public function testZero()
    {
        $this->assertEquals(0.2, Similarity::calculate(0,0));
    }
}
