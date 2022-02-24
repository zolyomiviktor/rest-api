<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TermekController;

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

Route::post("login",[AuthController::class, "login"]);
Route::post("register",[AuthController::class, "register"]);
Route::get("termeks",[TermekController::class, "index"]);
Route::post("termeks",[TermekController::class, "store"]);
Route::get("termeks/{termek}",[TermekController::class, "show"]);
Route::put("termeks/{termek}",[TermekController::class, "update"]);
Route::delete("termeks/{termek}",[TermekController::class, "destroy"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
