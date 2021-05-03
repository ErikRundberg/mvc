<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Debug;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = [
        "header" => "Index",
        "message" => "Hello, this is the index page."
    ];
    return view('index', $data);
});

Route::get('/session', function () {
    return view('session');
});

Route::get('/session/destroy', function () {
    session()->flush();
    return view('session');
});

Route::get('/debug', function () {
    return view('debug');
});


Route::get('/form/view', function () {
    $data = [
        "header" => "Form",
        "message" => "Press submit to send the message to the result page",
        "action" => url("/form/process"),
        "output" => session("output") ?? null
    ];
    return view("form", $data);
});

Route::post('/form/process', function() {
    session()->put("output", Request::get("content") ?? null);
    return redirect()->back();
});
