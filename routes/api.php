<?php

declare(strict_types=1);

use App\Http\Controllers\CreateTicketController;
use Illuminate\Support\Facades\Route;

Route::post('/tickets', CreateTicketController::class);
