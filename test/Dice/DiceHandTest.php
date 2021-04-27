<?php

namespace Erru\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    public function testCreateDiceHand()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
    }

    public function testGetResult()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $diceHand->rollAll();

        $res = $diceHand->getResult();
        $exp = [["dice-1"], ["dice-1"]];
        $this->assertEquals($res, $exp);
    }

    public function testGetThrows()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $diceHand->rollAll();

        $res = $diceHand->getThrows();
        $exp = [1, 1];
        $this->assertEquals($res, $exp);
    }

    public function testGetSum()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $diceHand->rollAll();

        $res = $diceHand->getSum();
        $exp = 2;
        $this->assertEquals($res, $exp);
    }

    public function testOverOverLimit()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 30;

        $res = $diceHand->overLimit();
        $exp = "You lost!";
        $this->assertEquals($res, $exp);
    }

    public function testUnderOverLimit()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 10;

        $res = $diceHand->overLimit();
        $exp = "";
        $this->assertEquals($res, $exp);
    }

    public function testComputerRoll()
    {
        $diceHand = new DiceHand(20, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 21;

        $res = $diceHand->computerRoll();
        $exp = 40;
        $this->assertEquals($res, $exp);
    }

    public function testCalculateWinLoss()
    {
        $diceHand = new DiceHand(20, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 22;
        $_SESSION["win"] = 0;
        $_SESSION["lose"] = 0;

        $res = $diceHand->calculateWin();
        $exp = "Player lost!";
        $this->assertEquals($res, $exp);
    }

    public function testCalculateWinPreComputer()
    {
        $diceHand = new DiceHand(20, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 3;
        $_SESSION["compSum"] = 0;
        $_SESSION["win"] = 0;
        $_SESSION["lose"] = 0;

        $res = $diceHand->calculateWin();
        $exp = "";
        $this->assertEquals($res, $exp);
    }

    public function testCalculateWinWin()
    {
        $diceHand = new DiceHand(20, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 3;
        $_SESSION["compSum"] = 32;
        $_SESSION["win"] = 0;
        $_SESSION["lose"] = 0;

        $res = $diceHand->calculateWin();
        $exp = "Player won!";
        $this->assertEquals($res, $exp);
    }

    public function testCalculateWinCompHigher()
    {
        $diceHand = new DiceHand(20, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $_SESSION["sum"] = 3;
        $_SESSION["compSum"] = 12;
        $_SESSION["win"] = 0;
        $_SESSION["lose"] = 0;

        $res = $diceHand->calculateWin();
        $exp = "Player lost!";
        $this->assertEquals($res, $exp);
    }

    public function testGetKeptResults()
    {
        $diceHand = new DiceHand(2, 1);
        $this->assertInstanceOf("\Erru\Dice\DiceHand", $diceHand);
        $dices = ["dice-1", "dice-1"];

        $res = $diceHand->getKeptResult($dices);
        $exp = [["dice-1"], ["dice-1"]];
        $this->assertEquals($res, $exp);
    }
}
