<?php

namespace Erru\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceObjectTest extends TestCase
{
    public function testCreateDice()
    {
        $dice = new Dice(4);
        $this->assertInstanceOf("\Erru\Dice\Dice", $dice);
    }

    public function testRoll()
    {
        $dice = new Dice(1);
        $this->assertInstanceOf("\Erru\Dice\Dice", $dice);

        $dice->roll();
        $res = $dice->getLastRoll();
        $exp = 1;
        $this->assertEquals($res, $exp);
    }
}
