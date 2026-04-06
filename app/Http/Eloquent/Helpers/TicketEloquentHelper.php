<?php

declare(strict_types=1);

namespace App\Http\Eloquent\Helpers;

use App\DTO\TicketData;
use App\Enums\TicketStatus;
use App\Models\Ticket;

class TicketEloquentHelper
{
    public function prepareData(TicketData $data, int $customerId, ?Ticket $ticket = null): Ticket
    {
        if (is_null($ticket)) {
            $ticket = new Ticket();
        }

        $ticket->customer_id = $customerId;
        // $ticket->customer_id = 1; // @TODO remove hardcode
        $ticket->subject = $data->subject;
        $ticket->message = $data->message;
        $ticket->status = $data->status ?? TicketStatus::NEW->value;
        $ticket->answered_at = $data->answeredAt;

        return $ticket;
    }
}
