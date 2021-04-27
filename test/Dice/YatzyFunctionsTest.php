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
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
    }

    public function testCheckPosts()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SERVER["REQUEST_METHOD"] = "";
        $yF->checkPosts();
    }

    public function testStartYatzy()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["startYatzy"] = "set";
        $yF->startYatzy();

        $this->assertEquals($_SESSION["roll"], 0);
        $this->assertEquals($_SESSION["yatzyRound"], 1);
    }

    public function testRollDice()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["rollYatzy"] = "set";

        $yF->rollDice();
        $this->assertEquals($_SESSION["roll"], 1);

        $yF->rollDice();
        $this->assertEquals($_SESSION["roll"], 2);
    }

    public function testGetRoundUnset()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SESSION["yatzyRound"] = null;

        $res = $yF->getRound();
        $this->assertNull($res);
    }

    public function testGetRoundSet()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SESSION["yatzyRound"] = 4;

        $res = $yF->getRound();
        $exp = "Round: 4";
        $this->assertEquals($res, $exp);
    }

    public function testGetRoundFinished()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SESSION["yatzyRound"] = 7;

        $res = $yF->getRound();
        $exp = "Game Finished!";
        $this->assertEquals($res, $exp);
    }

    public function testEndGame()
    {
        $yF = new YatzyFunctions();
        $this->assertInstanceOf("\Erru\Dice\YatzyFunctions", $yF);
        $_SESSION["yatzyRound"] = 7;
        foreach(range(0, 6) as $i) {
            $_SESSION["tableData"][$i] = 10;
        }

        $yF->endGame();
        $res = $_SESSION["tableData"][8];
        $exp = 110;
        $this->assertEquals($res, $exp);
    }
}
