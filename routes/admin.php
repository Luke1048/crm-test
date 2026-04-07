<?php

use App\Http\Controllers\ShowTicketItemController;
use App\Http\Controllers\ShowTicketListController;
use App\Http\Controllers\TicketFileDownloadController;
use App\Http\Controllers\UpdateTicketStatusController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin/tickets')
    ->name('admin.tickets.')
    ->middleware(['auth', 'role:manager'])
    ->group(function () {
        Route::get('/', ShowTicketListController::class)->name('list');
        Route::get('/{id}', ShowTicketItemController::class)->name('item');
        Route::put('/updateStatus', UpdateTicketStatusController::class)->name('updateStatus');
        Route::get('/file/{file}', TicketFileDownloadController::class)->name('file.download');
    });

require __DIR__.'/auth.php';
