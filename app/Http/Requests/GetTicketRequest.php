<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tickets,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    public function messages(): array
    {
        return [
            'id.required' => __('tickets.error.id_required'),
            'id.integer' => __('tickets.error.id_integer'),
            'id.exists' => __('tickets.error.id_not_found'),
        ];
    }
}
