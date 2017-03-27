<?php
/**
 * Created by PhpStorm.
 * User: lira
 * Date: 24/03/17
 * Time: 08:28
 */

namespace Test\Library;

use Challenge\Library\Stringer;

class StringerTest extends \UnitTestCase
{
    /**
     * Simple test using a little string separated by comma
     */
    public function testExplode()
    {
        $stringTest = 'test,unit,of,string';

        $responseArray = Stringer::string2Array($stringTest);

        $this->assertEquals('test', $responseArray[0]);
        $this->assertEquals('unit', $responseArray[1]);
        $this->assertEquals('of', $responseArray[2]);
        $this->assertEquals('string', $responseArray[3]);
        $this->assertCount(4, $responseArray);
    }

    /**
     * Test using another regex pattern
     */
    public function testExplodeAnotherPattern()
    {
        $stringTest = 'one>more>test';
        $pattern = '>';

        $responseArray = Stringer::string2Array($stringTest, $pattern);

        $this->assertEquals('one', $responseArray[0]);
        $this->assertEquals('more', $responseArray[1]);
        $this->assertEquals('test', $responseArray[2]);
        $this->assertCount(3, $responseArray);
    }
}
