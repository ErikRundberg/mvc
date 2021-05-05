<?php

namespace App\Models;

use Request;
use Tests\TestCase;

/**
 * Test cases for class GraphicalDice.
 */
class GraphicalDiceTest extends TestCase
{
    public function testCreateGraphicalDice()
    {
        $graphicalDice = new GraphicalDice();
        $this->assertInstanceOf("App\Models\GraphicalDice", $graphicalDice);
    }

    public function testMakeDice()
    {
        $graphicalDice = new GraphicalDice(1);
        $this->assertInstanceOf("App\Models\GraphicalDice", $graphicalDice);

        $graphicalDice->roll();
        $graphicalDice->makeDie();
        $res = $graphicalDice->getClass();
        $exp = ["dice-1"];
        $this->assertEquals($res, $exp);
    }
}
