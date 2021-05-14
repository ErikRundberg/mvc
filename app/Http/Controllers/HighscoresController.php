<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighscoresController extends Controller
{
    public function show()
    {
        $highscores = DB::table('highscores')
            ->orderBy('score', 'desc')
            ->limit(10)
            ->get();

        // dd($highscores);

        return view('highscores', ['highscores' => $highscores]);
    }
}
