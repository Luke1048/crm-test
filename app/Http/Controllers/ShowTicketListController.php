<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TicketFilterRequest;
use App\Http\Services\TicketService;
use Illuminate\View\View;

class ShowTicketListController extends Controller
{
    public function __invoke(
        TicketFilterRequest $request,
        TicketService $ticketService,
    ): View {
        $tickets = $ticketService->getTickets($request->toDTO());

        return view('admin.tickets', [
            'tickets' => $tickets
        ]);
    }
}
