<?php

namespace App\Models;

use Request;
use Http;
use Tests\TestCase;

/**
 * Test cases for class YatzyFunctions.
 */
class YatzyFunctionsTest extends TestCase
{
    public function testCreateYatzyFunctions()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
    }

    public function testCheckPosts()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        $this->withSession(["REQUEST_METHOD" => ""]);
        $yatzyFunctions->checkPosts();
    }

    public function testStartYatzy()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        $this->withSession(["REQUEST_METHOD" => "POST"]);
        $this->call('POST', '', ['startYatzy' => 'set']);
        $yatzyFunctions->startYatzy();

        $this->assertEquals(session("roll"), 0);
        $this->assertEquals(session("yatzyRound"), 1);
    }

    public function testRollDice()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        $this->withSession(["REQUEST_METHOD" => "POST"]);
        $this->call('POST', '', ['rollYatzy' => 'set']);

        $yatzyFunctions->rollDice();
        $this->assertEquals(session("roll"), 1);

        $yatzyFunctions->rollDice();
        $this->assertEquals(session("roll"), 2);
    }

    public function testGetRoundUnset()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        session(["yatzyRound" => null]);

        $res = $yatzyFunctions->getRound();
        $this->assertNull($res);
    }

    public function testGetRoundSet()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        session(["yatzyRound" => 4]);

        $res = $yatzyFunctions->getRound();
        $exp = "Round: 4";
        $this->assertEquals($res, $exp);
    }

    public function testGetRoundFinished()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        session(["yatzyRound" => 7]);

        $res = $yatzyFunctions->getRound();
        $exp = "Game Finished!";
        $this->assertEquals($res, $exp);
    }

    public function testEndGame()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        session(["yatzyRound" => 7]);
        foreach (range(0, 6) as $i) {
            session(["tableScore." . $i => 10]);
        }

        $yatzyFunctions->endGame();
        $res = session("tableScore.8");
        $exp = 110;
        $this->assertEquals($res, $exp);
    }

    public function testNextRound()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        $this->withSession(["REQUEST_METHOD" => "POST"]);
        $this->call('POST', '', ['nextRound' => 'set']);
        session(["yatzyRound" => 1]);
        session(["throws" => [1]]);

        $yatzyFunctions->nextRound();
        $this->assertEquals(session("roll"), 0);
        $this->assertEquals(session("tableScore.0"), 1);
        $this->assertNull(session("yatzyDice"));
    }

    public function testForceRoll()
    {
        $yatzyFunctions = new YatzyFunctions();
        $this->assertInstanceOf("App\Models\YatzyFunctions", $yatzyFunctions);
        $this->withSession(["REQUEST_METHOD" => "POST"]);
        $this->call('POST', '', ['keepDice' => 'set']);
        session(["diceArray" => null]);

        $yatzyFunctions->keepDice();
        $this->assertTrue(session("roll") != 0);
    }
}
