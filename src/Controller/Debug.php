<?php

declare(strict_types=1);

namespace Erru\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Erru\Functions\renderView;

/**
 * Controller for the debug route.
 */
class Debug
{
    public function __invoke(): ResponseInterface
    {
        $body = renderView("layout/debug.php");

        // Create and return the response
        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
