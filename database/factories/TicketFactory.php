<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        $customer = Customer::inRandomOrder()->first() ?? Customer::factory()->create();

        return [
            'customer_id' => $customer->id,
            'subject' => $this->faker->sentence(6, true),
            'message' => $this->faker->paragraph(3, true),
            'status' => $this->faker->randomElement([
                TicketStatus::NEW,
                TicketStatus::IN_PROGRESS,
                TicketStatus::PROCESSED,
            ]),
            'answered_at' => $this->faker->optional()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
