<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TicketFilterRequest;
use App\Http\Services\TicketService;
use Illuminate\View\View;

class ShowTicketListController extends Controller
{
    public function __construct(
        private readonly TicketService $ticketService,
    ) {
    }

    public function __invoke(TicketFilterRequest $request): View
    {
        $tickets = $this->ticketService->getTickets($request->toDTO());

        return view('admin.tickets', [
            'tickets' => $tickets
        ]);
    }
}
