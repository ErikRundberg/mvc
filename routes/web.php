<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\YatzyController;

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

Route::get('/', [IndexController::class, 'show']);

Route::get('/session', [SessionController::class, 'show']);

Route::get('/session/destroy', [SessionController::class, 'destroy']);

Route::get('/debug', [DebugController::class, 'show']);


Route::get('/form/view', [FormController::class, 'show']);

Route::post('/form/process', function() {
    session()->put("output", Request::get("content") ?? null);
    return redirect()->back();
});

Route::get('/yatzy', [YatzyController::class, 'show']);
Route::post('/yatzy', [YatzyController::class, 'show']);
