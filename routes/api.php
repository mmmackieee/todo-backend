<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [AuthController::class, 'users']); // example
    });

    Route::prefix('todos')->name('todo.')->group(function () {
        Route::get('/', [TodoController::class, 'index'])->name("index");
        Route::post('/store', [TodoController::class, 'store'])->name("store");
        Route::put('/{id}', [TodoController::class, 'update'])->name("update");
        Route::delete('/{id}', [TodoController::class, 'destroy'])->name("delete");
    });
});
