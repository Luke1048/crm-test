<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowFormTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/widget', ShowFormTicketController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
