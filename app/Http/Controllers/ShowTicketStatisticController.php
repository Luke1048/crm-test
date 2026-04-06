<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\TicketService;
use Illuminate\View\View;

class ShowTicketStatisticController extends Controller
{
    public function __construct(
        private readonly TicketService $ticketService,
    ) {
    }

    public function __invoke(): View
    {
        $tickets = $this->ticketService->getTickets();

        return view('admin.tickets', [
            'tickets' => $tickets
        ]);
    }
}
