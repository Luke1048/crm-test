<?php

namespace Tests\Feature;

use App\DTO\TicketData;
use App\Models\Customer;
use App\Models\Ticket;
use App\Http\Services\TicketService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_ticket_service(): void
    {
        $customer = Customer::factory()->create();

        $data = new TicketData(
            email: $customer->email,
            subject: 'Service Ticket',
            message: 'Testing service layer',
            attachments: []
        );

        $service = $this->app->make(TicketService::class);
        $ticket = $service->createTicket($data);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertEquals('Service Ticket', $ticket->subject);
        $this->assertEquals('Testing service layer', $ticket->message);
    }
}
