<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller for the index route.
 */
class IndexController extends Controller
{
    public function show()
    {
        $data = [
            "header" => "Index",
            "message" => "Hello, this is the index page."
        ];
        return view('index', $data);
    }
}
