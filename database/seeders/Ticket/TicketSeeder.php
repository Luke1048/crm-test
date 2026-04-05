<?php

declare(strict_types=1);

namespace Database\Seeders\Ticket;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Ticket::factory(100)->create();
    }
}
