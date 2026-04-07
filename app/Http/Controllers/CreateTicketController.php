<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\TicketData;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Http\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateTicketController extends Controller
{
    public function __invoke(
        StoreTicketRequest $request,
        TicketService $ticketService,
    ): JsonResponse {
        try {
            $ticket = $ticketService->createTicket(TicketData::fromRequest($request->validated()));

            return response()->json([
                'status' => 'success',
                'message' => __('tickets.success.ticket_created'),
                'ticket' => new TicketResource($ticket),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        }
    }
}
