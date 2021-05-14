<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    public function show()
    {
        $books = DB::table('books')->get();

        // dd($books);

        return view('books', ['books' => $books]);
    }
}
