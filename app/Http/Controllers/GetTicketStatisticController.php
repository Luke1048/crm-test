<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PeriodRequest;
use App\Http\Services\TicketService;
use Illuminate\Http\JsonResponse;

class GetTicketStatisticController extends Controller
{
    public function __invoke(
        PeriodRequest $request,
        TicketService $ticketService,
    ): JsonResponse {
        $tickets = $ticketService->getTicketStatistics($request->getPeriod());

        return response()->json([
            'status' => 'success',
            'message' => __('tickets.success.ticket_created'),
            'tickets' => $tickets,
        ]);
    }
}
