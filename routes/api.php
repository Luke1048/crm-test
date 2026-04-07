<?php

declare(strict_types=1);

use App\Http\Controllers\CreateTicketController;
use App\Http\Controllers\GetTicketStatisticController;
use Illuminate\Support\Facades\Route;

Route::prefix('tickets')->group(function () {
    Route::post('/', CreateTicketController::class);
    Route::get('/statistics', GetTicketStatisticController::class);
});

Route::get('/documentation', function () {
    return view('swagger');
});
