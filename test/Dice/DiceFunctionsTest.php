<?php

namespace Erru\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceFunctions.
 */
class DiceFunctionsTest extends TestCase
{
    public function testCreateDiceFunctions()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);
    }

    public function testCheckPosts()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);

        $_SERVER["REQUEST_METHOD"] = "";
        $diceFunctions->checkPosts();
    }

    public function testPostStart()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);

        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["start"] = "set";
        $_SESSION["sum"] = 0;
        $_POST["diceAmt"] = 1;
        $diceFunctions->postStart();
        $this->assertContains($_SESSION["sum"], [1, 2, 3, 4, 5, 6]);
    }

    public function testPostReset()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);

        $_SESSION["wins"] = 1;
        $_SESSION["lose"] = 1;
        $this->assertEquals($_SESSION["wins"], 1);
        $this->assertEquals($_SESSION["lose"], 1);

        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["reset"] = "set";
        $diceFunctions->postReset();

        $this->assertNull($_SESSION["wins"]);
        $this->assertNull($_SESSION["lose"]);
    }

    public function testForceRoll()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);
        $_SESSION["diceAmt"] = 1;
        $_SESSION["sum"] = 0;

        $diceFunctions->forceRoll();
        $this->assertContains($_SESSION["sum"], [1, 2, 3, 4, 5, 6]);
    }

    public function testPostStop()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);
        $_SESSION["diceAmt"] = 1;
        $_SESSION["sum"] = 1;
        $_POST["stop"] = "set";

        $diceFunctions->postStop();
        $this->assertEquals($_SESSION["message"], "Player lost!");
    }

    public function testPostBack()
    {
        $diceFunctions = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $diceFunctions);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST["back"] = "set";

        $diceFunctions->postBack();
        $this->assertNull($_SESSION["message"]);
        $this->assertNull($_SESSION["diceAmt"]);
        $this->assertNull($_SESSION["sum"]);
        $this->assertNull($_SESSION["compSum"]);
        $this->assertNull($_SESSION["dices"]);
    }
}
