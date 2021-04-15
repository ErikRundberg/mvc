<?php

declare(strict_types=1);

namespace Erru\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Erru\Functions\renderView;
use Erru\Dice\YatzyFunctions;

/**
 * Controller for the game-21 route.
 */
class Yatzy
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $yf = new YatzyFunctions();

        $data = [
            "title" => "Yatzy",
            "header" => "Yatzy",
            "message" => "ROLL ON"
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
