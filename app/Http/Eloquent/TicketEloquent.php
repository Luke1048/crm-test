<?php

declare(strict_types=1);

namespace App\Http\Eloquent;

use App\DTO\TicketFilterData;
use App\Enums\TicketFilter;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class TicketEloquent
{
    public function __construct(
        private Ticket $model
    ) {
    }

    public function getById(int  $id): Ticket
    {
        return $this->model
            ->findOrFail($id);
    }

    public function save(Ticket $ticket): Ticket
    {
        $ticket->save();

        return $ticket;
    }

    public function updateStatus(Ticket $ticket, string $status): Ticket
    {
        $ticket->status = $status;
        $ticket->save();

        return $ticket;
    }

    public function getList(?TicketFilterData $filter = null): LengthAwarePaginator
    {
        $query = $this->model->query()->with('customer');

        if (!$filter) {
            return $query->paginate(10)->withQueryString();
        }

        foreach (TicketFilter::cases() as $field) {
            $value = $filter->{$field->value};
            if (!$value) {
                continue;
            }

            match ($field) {
                TicketFilter::FROM_DATE => $query->whereDate('created_at', '>=', $value),
                TicketFilter::TO_DATE => $query->whereDate('created_at', '<=', $value),
                TicketFilter::STATUS => $query->where('status', $value),
                TicketFilter::EMAIL => $query->whereRelation('customer', 'email', 'like', "%{$value}%"),
                TicketFilter::PHONE => $query->whereRelation('customer', 'phone', 'like', "%{$value}%"),
            };
        }

        return $query->paginate(10)->withQueryString();
    }
}
