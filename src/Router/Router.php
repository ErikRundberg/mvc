<?php

declare(strict_types=1);

namespace Erru\Router;

use Erru\Dice\DiceHand;

use function Erru\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url,
    resetScore
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/game-21") {
            resetScore();
            $data = [
                "header" => "Game 21",
                "title" => "Game 21",
                "win" => $_SESSION["win"],
                "lose" => $_SESSION["lose"],
            ];
            $body = renderView("layout/dice.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/game-21") {
            $_SESSION["sides"] = $_POST["dice_amt"];
            $_SESSION["sum"] = 0;
            $_SESSION["compSum"] = 0;
            redirectTo("game-start");
            return;
        } else if ($method === "GET" && $path === "/game-start") {
            $sides = $_SESSION["sides"];
            $diceHand = new DiceHand($sides);
            $diceHand->rollAll();
            $_SESSION["sum"] += $diceHand->getSum();
            $data = [
                "header" => "Game 21 - " . $sides . " dice",
                "title" => "Game 21",
                "dices" => $diceHand->getResult(),
                "sum" => $_SESSION["sum"],
                "message" => $diceHand->calculateWin(),
            ];
            $body = renderView("layout/dice-start.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/roll") {
            redirectTo("game-start");
            return;
        } else if ($method === "POST" && $path === "/back") {
            redirectTo("game-21");
            return;
        } else if ($method === "POST" && $path === "/stop") {
            redirectTo("game-stop");
            return;
        } else if ($method === "GET" && $path === "/game-stop") {
            $sides = $_SESSION["sides"];
            $diceHand = new DiceHand($sides);
            $_SESSION["compSum"] = $diceHand->computerRoll();
            $data = [
                "header" => "Game 21 - " . $sides . " dice",
                "title" => "Game 21",
                "sum" => $_SESSION["sum"],
                "compSum" => $_SESSION["compSum"],
                "message" => $diceHand->calculateWin(),
            ];
            $body = renderView("layout/dice-stop.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/reset") {
            destroySession();
            redirectTo("game-21");
            return;
        }
        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
