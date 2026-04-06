<?php

declare(strict_types=1);

namespace App\Http\Eloquent;

use App\Models\Ticket;

readonly class TicketEloquent
{
    public function save(Ticket $ticket): Ticket
    {
        $ticket->save();

        return $ticket;
    }
}
