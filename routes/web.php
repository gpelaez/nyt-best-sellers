<?php

use App\Http\Controllers\BoooksController;
use Illuminate\Support\Facades\Route;

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

// Wildcard route for single page application using js routing.
Route::get('/{any}', function () {
    return view('spa');
})->where('any', '.*');