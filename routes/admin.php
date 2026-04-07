<?php

use App\Http\Controllers\ShowTicketListController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/tickets', ShowTicketListController::class)->middleware(['auth', 'role:manager'])->name('admin.tickets');

require __DIR__.'/auth.php';
