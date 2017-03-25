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
    public function testExplode()
    {
        var_dump(Stringer::string2Array('pipoca,laje'));
    }
}
