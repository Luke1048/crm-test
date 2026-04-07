<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTicketStatusRequest;
use App\Http\Services\TicketService;
use Illuminate\Http\RedirectResponse;

class UpdateTicketStatusController extends Controller
{
    public function __invoke(
        UpdateTicketStatusRequest $request,
        TicketService $ticketService,
    ): RedirectResponse {
        $ticketService->updateTicketStatus((int) $request->input('id'), $request->input('status'));

        return redirect()->route('admin.tickets.list')
            ->with('success', __('tickets.success.ticket_updated'));
    }
}
