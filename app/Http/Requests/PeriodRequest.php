<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Period;
use Illuminate\Validation\Rules\Enum;

class PeriodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'period' => ['required', new Enum(Period::class)],
        ];
    }

    public function getPeriod(): Period
    {
        $period = $this->query('period');
        return Period::from($period);
    }
}
