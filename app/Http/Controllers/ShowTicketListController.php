<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\TicketService;
use Illuminate\View\View;

class ShowTicketListController extends Controller
{
    public function __construct(
        private readonly TicketService $ticketService,
    ) {
    }

    public function __invoke(): View
    {
        $fromDate = request('from_date');
        $toDate = request('to_date');
        $status = request('status');
        $email = request('email');
        $phone = request('phone');

        $tickets = $this->ticketService->getTickets($fromDate, $toDate, $status, $email, $phone);

        return view('admin.tickets', [
            'tickets' => $tickets
        ]);
    }
}
