<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function show()
    {
        $books = \App\Models\Book::all();

        // dd($books);

        return view('books', ['books' => $books]);
    }
}
