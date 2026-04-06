<?php

declare(strict_types=1);

namespace App\Http\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomerFindException extends HttpException
{
    public function __construct(?string $message = null)
    {
        parent::__construct(
            404,
            $message ?? __('customers.error.customer_not_found')
        );
    }
}

