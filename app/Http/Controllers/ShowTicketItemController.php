<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\GetTicketRequest;
use App\Http\Services\TicketService;
use Illuminate\View\View;

class ShowTicketItemController extends Controller
{
    public function __invoke(
        GetTicketRequest $request,
        TicketService $ticketService,
     ): View {
        $ticket = $ticketService->getTicket((int) $request->input('id'));

        return view('admin.ticket', [
            'ticket' => $ticket
        ]);
    }
}
