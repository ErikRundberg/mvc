<?php

namespace Erru\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GraphicalDice.
 */
class GraphicalDiceTest extends TestCase
{
    public function testCreateGraphicalDice()
    {
        $graphicalDice = new GraphicalDice();
        $this->assertInstanceOf("\Erru\Dice\GraphicalDice", $graphicalDice);
    }

    public function testMakeDice()
    {
        $graphicalDice = new GraphicalDice(1);
        $this->assertInstanceOf("\Erru\Dice\GraphicalDice", $graphicalDice);

        $graphicalDice->roll();
        $graphicalDice->makeDie();
        $res = $graphicalDice->getClass();
        $exp = ["dice-1"];
        $this->assertEquals($res, $exp);
    }
}
