<?php

use App\Http\Controllers\ShowTicketStatisticController;
use Illuminate\Support\Facades\Route;

Route::get('/tickets', ShowTicketStatisticController::class)->middleware(['auth', 'role:manager'])->name('admin.tickets');

require __DIR__.'/auth.php';
