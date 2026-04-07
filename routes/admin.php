<?php

use App\Http\Controllers\ShowTicketListController;
use App\Http\Controllers\UpdateTicketStatusController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/tickets')
    ->middleware(['auth', 'role:manager'])
    ->group(function () {
        Route::get('/', ShowTicketListController::class)->name('admin.tickets');
        Route::put('/updateStatus', UpdateTicketStatusController::class)->name('admin.tickets.updateStatus');
    });

require __DIR__.'/auth.php';
