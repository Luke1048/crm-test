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
use Illuminate\Support\Collection;
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

        if ($data->attachments) {
            $this->saveAttachment($data->attachments, $ticket);
        }

        return $ticket;
    }

    private function saveAttachment(array $uploadedFiles, Ticket $ticket): void
    {
        foreach ($uploadedFiles as $uploadedFile) {
            $path = $uploadedFile->store('tickets');

            $file = $this->fileEloquentHelper->prepareData(
                new FileData(
                        ticketId: $ticket->id,
                        name: $uploadedFile->getClientOriginalName(),
                        path: $path,
                )
            );

            $this->fileEloquent->save($file);
        }
    }

    public function getTicketStatistics(): Collection
    {
        return $this->ticketEloquent->getByPeriod();
    }
}
