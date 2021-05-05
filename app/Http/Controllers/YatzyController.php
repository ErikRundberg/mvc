<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\YatzyFunctions;

/**
 * Controller for the yatzy route.
 */
class YatzyController extends Controller
{
    public function show()
    {
        $yatzy = new YatzyFunctions();
        $yatzy->checkPosts();

        $data = [
            "title" => "Yatzy",
            "header" => $yatzy->getRound(),
            "dice" => session("yatzyDice"),
            "tableName" => session('tableName'),
            "tableScore" => session('tableScore')
        ];
        return view("yatzy", $data);
    }
}
