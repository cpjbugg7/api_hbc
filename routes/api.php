<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('airports', 'App\Http\Controllers\AirportController');
    Route::resource('airlines', 'App\Http\Controllers\AirlineController');
    Route::resource('flights', 'App\Http\Controllers\FlightController');
});

Route::post('login', [LoginController::class,'login'])->name('login');
Route::post('logout', [LoginController::class,'logout'])->name('logout');;
