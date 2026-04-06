<?php

declare(strict_types=1);

namespace App\Http\Eloquent;

use App\Models\Ticket;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class TicketEloquent
{
    public function __construct(
        private Ticket $model
    ) {
    }

    public function save(Ticket $ticket): Ticket
    {
        $ticket->save();

        return $ticket;
    }

    public function getList(): LengthAwarePaginator
    {
        return $this->model->paginate(10);
    }
}
