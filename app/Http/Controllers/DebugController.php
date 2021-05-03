<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller for the debug route.
 */
class DebugController extends Controller
{
    public function show()
    {
        return view('debug');
    }
}
