<?php

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

Route::get('/list-cards', [\App\Http\Controllers\API\CardController::class, 'index']);

Route::get('/column/get', [\App\Http\Controllers\API\ColumnController::class, 'index']);
Route::post('/column/create', [\App\Http\Controllers\API\ColumnController::class, 'create']);
Route::delete('/column/delete/{column}', [\App\Http\Controllers\API\ColumnController::class, 'delete']);


Route::post('/column/{column}/card/create', [\App\Http\Controllers\API\ColumnController::class, 'createCard']);
Route::put('/column/card/update/{card}', [\App\Http\Controllers\API\ColumnController::class, 'updateCard']);
Route::delete('/column/card/delete/{card}', [\App\Http\Controllers\API\ColumnController::class, 'deleteCard']);
Route::post('/column/card/update/index', [\App\Http\Controllers\API\ColumnController::class, 'updateCardIndex']);
