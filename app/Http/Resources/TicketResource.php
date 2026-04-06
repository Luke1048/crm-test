<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Ticket
 */
class TicketResource extends JsonResource
{
    public function toArray($request): array
    {
        // dd($this->files);

        return [
            'id' => $this->id,
            'customer' => new CustomerResource($this->customer),
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => $this->status,
            'answered_at' => $this->answered_at?->toDateTimeString(),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
            // 'file' => new FileResource($this->files),
            'files' => FileResource::collection($this->files),
        ];
    }
}
