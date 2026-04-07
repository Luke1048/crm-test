<?php

declare(strict_types=1);

namespace App\DTO;

final class TicketFilterData
{
    public function __construct(
        public ?string $fromDate = null,
        public ?string $toDate = null,
        public ?string $status = null,
        public ?string $email = null,
        public ?string $phone = null,
    ) {
    }
}
