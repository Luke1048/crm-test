<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Enums\TicketStatus;

class UpdateTicketStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tickets,id'],
            'status' => ['required', 'string', 'in:' . implode(',', array_column(TicketStatus::cases(), 'value'))],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => __('tickets.error.id_required'),
            'id.integer' => __('tickets.error.id_integer'),
            'id.exists' => __('tickets.error.id_not_found'),

            'status.required' => __('tickets.error.status_required'),
            'status.in' => __('tickets.error.status_invalid'),
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
