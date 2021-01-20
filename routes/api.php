<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\TaskController;
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

Route::apiResource('task', TaskController::class);
// Route::apiResource('card', CardController::class);


Route::get('card/{task_id}', [CardController::class, 'index'])->name('card.index');
Route::get('card/{card_id}/{task_id}', [CardController::class, 'show'])->name('card.show');
Route::post('card/{task_id}', [CardController::class, 'store'])->name('card.store');
Route::put('card/{card_id}/{task_id}', [CardController::class, 'update'])->name('card.update');
Route::put('card/{card_id}/{task_id}/update', [CardController::class, 'updateIsComplete'])->name('is_complete.update');
Route::delete('card/{card_id}/{task_id}', [CardController::class, 'destroy'])->name('card.destroy');


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
});
