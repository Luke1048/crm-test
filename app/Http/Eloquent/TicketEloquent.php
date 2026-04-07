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

    public function getList(
        ?string $fromDate = null,
        ?string $toDate = null,
        ?string $status = null,
        ?string $email = null,
        ?string $phone = null
    ): LengthAwarePaginator {
        $query = $this->model->query()->with('customer');

        if ($fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($email) {
            $query->whereRelation('customer', 'email', 'like', "%{$email}%");
        }

        if ($phone) {
            $query->whereRelation('customer', 'phone', 'like', "%{$phone}%");
        }

        return $query->paginate(10)->withQueryString();
    }
}
