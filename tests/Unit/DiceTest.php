<?php

namespace App\Models;

use Request;
use Tests\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceObjectTest extends TestCase
{
    public function testCreateDice()
    {
        $dice = new Dice(4);
        $this->assertInstanceOf("App\Models\Dice", $dice);
    }

    public function testRoll()
    {
        $dice = new Dice(1);
        $this->assertInstanceOf("App\Models\Dice", $dice);

        $dice->roll();
        $res = $dice->getLastRoll();
        $exp = 1;
        $this->assertEquals($res, $exp);
    }
}
