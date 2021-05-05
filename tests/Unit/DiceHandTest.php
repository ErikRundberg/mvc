<?php

namespace App\Models;

use Request;
use Tests\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    public function testCreateDiceHand()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("App\Models\DiceHand", $diceHand);
    }

    public function testGetResult()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("App\Models\DiceHand", $diceHand);
        $diceHand->rollAll();

        $res = $diceHand->getResult();
        $exp = [["dice-1"], ["dice-1"]];
        $this->assertEquals($res, $exp);
    }

    public function testGetThrows()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("App\Models\DiceHand", $diceHand);
        $diceHand->rollAll();

        $res = $diceHand->getThrows();
        $exp = [1, 1];
        $this->assertEquals($res, $exp);
    }

    public function testGetSum()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("App\Models\DiceHand", $diceHand);
        $diceHand->rollAll();

        $res = $diceHand->getSum();
        $exp = 2;
        $this->assertEquals($res, $exp);
    }

    public function testGetKeptResults()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("App\Models\DiceHand", $diceHand);
        $dices = ["dice-1", "dice-1"];

        $res = $diceHand->getKeptResult($dices);
        $exp = [["dice-1"], ["dice-1"]];
        $this->assertEquals($res, $exp);
    }
}
