<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller for the form route.
 */
class FormController extends Controller
{
    public function show()
    {
        $data = [
            "header" => "Form",
            "message" => "Press submit to send the message to the result page",
            "action" => url("/form/process"),
            "output" => session("output") ?? null
        ];
        return view("form", $data);
    }
}
