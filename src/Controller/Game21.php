<?php

declare(strict_types=1);

namespace Erru\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Erru\Functions\renderView;
use Erru\Dice\DiceFunctions;

/**
 * Controller for the game-21 route.
 */
class Game21
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $df = new DiceFunctions();
        $df->checkPosts();

        $data = [
            "header" => "Game 21",
            "title" => "Dice",
            "message" => $_SESSION["message"],
            "win" => $_SESSION["win"],
            "lose" => $_SESSION["lose"],
            "dices" => $_SESSION["dices"],
            "diceAmt" => $_SESSION["diceAmt"],
            "sum" => $_SESSION["sum"],
            "compSum" => $_SESSION["compSum"]
        ];

        $body = renderView("layout/dice.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
