<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller for the session route.
 */
class SessionController extends Controller
{
    public function show()
    {
        return view('session');
    }

    public function destroy()
    {
        session()->flush();
        return view('session');
    }
}
