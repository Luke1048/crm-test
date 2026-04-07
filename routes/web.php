<?php

use App\Http\Controllers\ShowFormTicketController;
use App\Http\Controllers\ShowTicketStatisticController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/widget', ShowFormTicketController::class)->middleware(['auth'])->name('ticket');
Route::get('/statistics', ShowTicketStatisticController::class)->middleware(['auth'])->name('statistics');

require __DIR__.'/auth.php';
