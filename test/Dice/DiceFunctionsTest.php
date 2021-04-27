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
        $dF = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $dF);
    }

    public function testCheckPosts()
    {
        $dF = new DiceFunctions();
        $this->assertInstanceOf("\Erru\Dice\DiceFunctions", $dF);

        $_SERVER["REQUEST_METHOD"] = "";
        $dF->checkPosts();
    }


}
