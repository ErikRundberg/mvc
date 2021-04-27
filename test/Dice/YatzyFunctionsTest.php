<?php

namespace Erru\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class YatzyFunctions.
 */
class YatzyFunctionsTest extends TestCase
{
    public function testCreateYatzyFunctions()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
    }

    public function testCheckPosts()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SERVER["REQUEST_METHOD"] = "";
        $yatzyFunctions->checkPosts();
    }

    public function testStartYatzy()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["startYatzy"] = "set";
        $yatzyFunctions->startYatzy();

        $this->assertEquals($_SESSION["roll"], 0);
        $this->assertEquals($_SESSION["yatzyRound"], 1);
    }

    public function testRollDice()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["rollYatzy"] = "set";

        $yatzyFunctions->rollDice();
        $this->assertEquals($_SESSION["roll"], 1);

        $yatzyFunctions->rollDice();
        $this->assertEquals($_SESSION["roll"], 2);
    }

    public function testGetRoundUnset()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SESSION["yatzyRound"] = null;

        $res = $yatzyFunctions->getRound();
        $this->assertNull($res);
    }

    public function testGetRoundSet()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SESSION["yatzyRound"] = 4;

        $res = $yatzyFunctions->getRound();
        $exp = "Round: 4";
        $this->assertEquals($res, $exp);
    }

    public function testGetRoundFinished()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SESSION["yatzyRound"] = 7;

        $res = $yatzyFunctions->getRound();
        $exp = "Game Finished!";
        $this->assertEquals($res, $exp);
    }

    public function testEndGame()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SESSION["yatzyRound"] = 7;
        foreach (range(0, 6) as $i) {
            $_SESSION["tableData"][$i] = 10;
        }

        $yatzyFunctions->endGame();
        $res = $_SESSION["tableData"][8];
        $exp = 110;
        $this->assertEquals($res, $exp);
    }

    public function testKeepDiceEmpty()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["keepDice"] = "set";

        $_SESSION["roll"] = 0;
        $_POST["diceArray"] = [];
        $yatzyFunctions->keepDice();
        $this->assertEquals($_SESSION["roll"], 2);
    }

    public function testKeepDice()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["keepDice"] = "set";

        $_SESSION["roll"] = 0;
        $_POST["diceArray"] = ["dice-1", "dice-1"];
        $yatzyFunctions->keepDice();
        $this->assertEquals($_SESSION["roll"], 1);
    }

    public function testNextRound()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yatzyFunctions);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["nextRound"] = "set";
        $_SESSION["yatzyRound"] = 1;
        $_SESSION["DiceHand"] = new DiceHand(1, 1);
        $_SESSION["DiceHand"]->rollAll();

        $yatzyFunctions->nextRound();
        $this->assertEquals($_SESSION["roll"], 0);
        $this->assertEquals($_SESSION["tableData"][0], 1);
        $this->assertNull($_SESSION["yatzyDice"]);
    }
}
