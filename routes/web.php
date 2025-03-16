<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    Route::get('/movies/search', [MovieController::class, 'search']);
    Route::post('/movies/add', [MovieController::class, 'add']);
    Route::get('/movies/watchlist', [MovieController::class, 'watchlist']);
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
    Route::post('/movies/{movie}/pin', [MovieController::class, 'pin']);
});

require __DIR__.'/auth.php';
