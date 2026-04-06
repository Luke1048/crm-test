<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\DTO\FileData;
use App\DTO\TicketData;
use App\Http\Eloquent\FileEloquent;
use App\Http\Eloquent\Helpers\FileEloquentHelper;
use App\Http\Eloquent\Helpers\TicketEloquentHelper;
use App\Http\Eloquent\TicketEloquent;
use App\Models\Ticket;
use App\Models\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class TicketService
{
    public function __construct(
        private TicketEloquentHelper $ticketEloquentHelper,
        private TicketEloquent $ticketEloquent,
        private FileEloquentHelper $fileEloquentHelper,
        private FileEloquent $fileEloquent,
    ) {
    }

    public function createTicket(TicketData $data): Ticket
    {
        $ticket = $this->ticketEloquent->save($this->ticketEloquentHelper->prepareData($data));

        if ($data->attachment) {
            $this->saveAttachment($data->attachment, $ticket);
        }

        return $ticket;
    }

    private function saveAttachment(UploadedFile $uploadedFile, Ticket $ticket): File
    {
        $path = $uploadedFile->store('tickets');

        $file = $this->fileEloquentHelper->prepareData(new FileData(
            ticketId: $ticket->id,
            name: $uploadedFile->getClientOriginalName(),
            path: $path,
        ));

        return $this->fileEloquent->save($file);
    }
}
