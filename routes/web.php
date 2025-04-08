<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('app');
});
Route::get('/login', [LoginController::class, 'index'])->name('index');

Route::get('/generator', [App\Http\Controllers\GeneratorController::class, 'index']);
Route::post('/generator', [App\Http\Controllers\GeneratorController::class, 'generate']);
