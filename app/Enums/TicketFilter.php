<?php

declare(strict_types=1);

namespace App\Enums;

enum TicketFilter: string
{
    case FROM_DATE = 'fromDate';
    case TO_DATE = 'toDate';
    case STATUS = 'status';
    case EMAIL = 'email';
    case PHONE = 'phone';
}
