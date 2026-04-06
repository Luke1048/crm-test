<?php

declare(strict_types=1);

namespace App\Http\Eloquent\Helpers;

use App\DTO\FileData;
use App\DTO\TicketData;
use App\Enums\TicketStatus;
use App\Models\File;
use App\Models\Ticket;

class FileEloquentHelper
{
    public function prepareData(FileData $data, ?File $file = null): File
    {
        if (is_null($file)) {
            $file = new File();
        }

        $file->ticket_id = $data->ticketId;
        $file->name = $data->name;
        $file->path = $data->path;

        return $file;
    }
}
