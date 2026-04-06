<?php

declare(strict_types=1);

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

final class TicketData
{
    /**
     * @param ?UploadedFile[] $attachments
     */
    public function __construct(
        public string $email,
        public string $subject,
        public string $message,
        public ?string $status = null,
        public ?array $attachments = null,
        public ?Carbon $answeredAt = null,
    ) {
    }

    public static function fromRequest(array $validated): self
    {
        return new self(
            email: $validated['email'],
            subject: $validated['subject'],
            message: $validated['message'],
            attachments: $validated['attachments'] ?? null,
        );
    }
}
