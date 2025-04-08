<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});
Route::get('/generator', [App\Http\Controllers\GeneratorController::class, 'index']);
Route::post('/generator', [App\Http\Controllers\GeneratorController::class, 'generate']);
