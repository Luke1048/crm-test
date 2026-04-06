<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\DTO\TicketData;
use App\Http\Eloquent\Helpers\TicketEloquentHelper;
use App\Http\Eloquent\TicketEloquent;
use App\Models\Ticket;

readonly class TicketService
{
    public function __construct(
        private TicketEloquentHelper $ticketEloquentHelper,
        private TicketEloquent $ticketEloquent,
    ) {
    }

    public function createTicket(TicketData $data): Ticket
    {
        return $this->ticketEloquent->save($this->ticketEloquentHelper->prepareData($data));
    }
}
