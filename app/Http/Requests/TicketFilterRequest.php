<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\TicketFilterData;
use Illuminate\Foundation\Http\FormRequest;

class TicketFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'status' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ];
    }

    public function toDTO(): TicketFilterData
    {
        return new TicketFilterData(
            fromDate: $this->input('from_date'),
            toDate: $this->input('to_date'),
            status: $this->input('status'),
            email: $this->input('email'),
            phone: $this->input('phone')
        );
    }
}
