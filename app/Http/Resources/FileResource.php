<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\File;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin File
 */
class FileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'ticket_id' => $this->ticket_id,
            'name' => $this->name,
            'url' => $this->path,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
