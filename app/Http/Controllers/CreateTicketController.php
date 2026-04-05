<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use Illuminate\Http\JsonResponse;

class CreateTicketController extends Controller
{
    public function __invoke(StoreTicketRequest $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => __('tickets.success.ticket_created')
        ]);
    }
}
