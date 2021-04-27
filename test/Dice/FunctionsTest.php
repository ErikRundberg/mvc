<?php

namespace Erru\Functions;

use PHPUnit\Framework\TestCase;

use function Erru\Functions\{
    getRoutePath,
    sendResponse,
    redirectTo,
    destroySession,
    resetScore
};

/**
 * Test cases for class Functions.
 */
class FunctionsTest extends TestCase
{
    public function testGetRoutePath()
    {
        $_SERVER["SCRIPT_NAME"] = "game/build/coverage/";
        $_SERVER["REQUEST_URI"] = "game/build/coverage/functions.php.html";

        $res = getRoutePath();
        $exp = "/coverage/functions.php.html";
        $this->assertEquals($res, $exp);
    }

    public function testSendResponse()
    {
        $exp = "test";
        $this->expectOutputString($exp);
        sendResponse("test");
        $this->assertEquals(http_response_code(), 200);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRedirectTo()
    {
        redirectTo("test");
        $this->assertEquals(http_response_code(), 302);
    }

    /**
     * @runInSeparateProcess
     */
    public function testDestroySession()
    {
        session_start();
        $_SESSION["test"] = "test";
        $this->assertEquals($_SESSION["test"], "test");
        destroySession();
        $this->assertEmpty($_SESSION);
    }

    /**
     * @runInSeparateProcess
     */
    public function testResetScore()
    {
        session_start();
        $_SESSION["win"] = 10;
        $_SESSION["lose"] = 10;
        destroySession();
        resetScore();
        $this->assertEquals($_SESSION["win"], 0);
        $this->assertEquals($_SESSION["lose"], 0);
    }
}
