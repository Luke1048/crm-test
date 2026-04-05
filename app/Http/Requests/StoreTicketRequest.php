<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|min:3|max:50|exists:customers,email',
            'subject' => 'required|string|min:5|max:50',
            'message' => 'required|string|min:5|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('tickets.error.email_required'),
            'email.email' => __('tickets.error.email_invalid'),
            'email.min' => __('tickets.error.email_min', ['min' => 3]),
            'email.max' => __('tickets.error.email_max', ['max' => 50]),
            'email.exists' => __('tickets.error.email_exists'),

            'subject.required' => __('tickets.error.subject_required'),
            'subject.string' => __('tickets.error.subject_string'),
            'subject.min' => __('tickets.error.subject_min', ['min' => 5]),
            'subject.max' => __('tickets.error.subject_max', ['max' => 50]),

            'message.required' => __('tickets.error.message_required'),
            'message.string' => __('tickets.error.message_string'),
            'message.min' => __('tickets.error.message_min', ['min' => 5]),
            'message.max' => __('tickets.error.message_max', ['max' => 255]),
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
