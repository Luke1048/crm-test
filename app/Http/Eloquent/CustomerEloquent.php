<?php

declare(strict_types=1);

namespace App\Http\Eloquent;

use App\Http\Exceptions\CustomerFindException;
use App\Models\Customer;
use App\Models\Ticket;

readonly class CustomerEloquent
{
    public function __construct(
        private Customer $model
    ) {
    }

    /**
     * @throws CustomerFindException
     */
    public function getByEmail(string $email): Customer
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }
}
