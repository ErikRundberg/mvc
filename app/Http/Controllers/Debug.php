<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller for the debug route.
 */
class Debug extends Controller
{
    public function __invoke()
    {
        return view("debug");
    }
}
