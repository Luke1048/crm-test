<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\DTO\FileData;
use App\DTO\TicketData;
use App\Http\Eloquent\CustomerEloquent;
use App\Http\Eloquent\FileEloquent;
use App\Http\Eloquent\Helpers\FileEloquentHelper;
use App\Http\Eloquent\Helpers\TicketEloquentHelper;
use App\Http\Eloquent\TicketEloquent;
use App\Http\Exceptions\CustomerFindException;
use App\Models\Ticket;
use App\Models\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class TicketService
{
    public function __construct(
        private CustomerEloquent $customerEloquent,
        private TicketEloquentHelper $ticketEloquentHelper,
        private TicketEloquent $ticketEloquent,
        private FileEloquentHelper $fileEloquentHelper,
        private FileEloquent $fileEloquent,
    ) {
    }

    /**
     * @throws CustomerFindException
     */
    public function createTicket(TicketData $data): Ticket
    {
        $customer = $this->customerEloquent->getByEmail($data->email);

        $ticket = $this->ticketEloquent->save(
            $this->ticketEloquentHelper->prepareData(data: $data, customerId: $customer->id)
        );

        if ($data->attachment) {
            $this->saveAttachment($data->attachment, $ticket);
        }

        return $ticket;
    }

    private function saveAttachment(UploadedFile $uploadedFile, Ticket $ticket): void
    {
        $path = $uploadedFile->store('tickets');

        $file = $this->fileEloquentHelper->prepareData(new FileData(
            ticketId: $ticket->id,
            name: $uploadedFile->getClientOriginalName(),
            path: $path,
        ));

        $this->fileEloquent->save($file);
    }
}
