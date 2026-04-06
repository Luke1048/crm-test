<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

final class TicketData
{
    public function __construct(
        // public int     $customerId,
        public string $email,
        public string $subject,
        public string $message,
        public ?string $status = null,
        public ?UploadedFile $attachment = null,
        public ?Carbon $answeredAt = null,
    ) {
    }

    public static function fromRequest(array $validated): self
    {
        return new self(
        // customerId: $customerId,
            email: $validated['email'],
            subject: $validated['subject'],
            message: $validated['message'],
            attachment: $validated['attachment'],
        );
    }
}
