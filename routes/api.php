<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Book Routes

Route::prefix('/book')->group(function(){
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::post('/create', [BookController::class, 'create']);
    Route::put('/edit/{id}', [BookController::class, 'edit']);
    Route::delete('/{id}', [BookController::class, 'delete']);


});

// Author Routes
Route::prefix('/author')->group(function () {
    Route::get('/', [AuthorController::class, 'index']);
    Route::get('/{id}', [AuthorController::class, 'show']);
    Route::post('/create', [AuthorController::class, 'create']);
    Route::put('/edit/{id}', [AuthorController::class, 'edit']);
    Route::delete('/{id}', [AuthorController::class, 'delete']);
});

// User routes
Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/count', [UserController::class, 'count']);
    Route::post('/create', [UserController::class, 'create']);
    Route::put('/edit/{id}', [UserController::class, 'edit']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
