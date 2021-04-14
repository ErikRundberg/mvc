<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? null;

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Erru\Controller\Index");
$router->addRoute("GET", "/debug", "\Erru\Controller\Debug");
$router->addRoute("GET", "/game-21", "\Erru\Controller\Game21");
$router->addRoute("POST", "/game-21", "\Erru\Controller\Game21");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Erru\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Erru\Controller\Session", "destroy"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\Erru\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\Erru\Controller\Form", "process"]);
});
