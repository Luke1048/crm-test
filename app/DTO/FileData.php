<?php

declare(strict_types=1);

namespace App\DTO;

final class FileData
{
    public function __construct(
        public int $ticketId,
        public string $name,
        public string $path,
    ) {
    }
}
