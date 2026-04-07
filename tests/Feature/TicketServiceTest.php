<?php

namespace Tests\Feature;

use App\DTO\TicketData;
use App\Enums\Period;
use App\Enums\TicketStatus;
use App\Models\Customer;
use App\Models\Ticket;
use App\Http\Services\TicketService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class TicketServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticketService = $this->app->make(TicketService::class);

        $this->customer = Customer::factory()->create();
    }


    public function test_create_ticket_service(): void
    {
        $data = new TicketData(
            email: $this->customer->email,
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

    public function test_creating_second_ticket_same_day_throws_exception(): void
    {
        $firstTicketData = new TicketData(
            email: $this->customer->email,
            subject: 'First Ticket',
            message: 'This is the first ticket',
            attachments: []
        );
        $this->ticketService->createTicket($firstTicketData);

        $secondTicketData = new TicketData(
            email: $this->customer->email,
            subject: 'Second Ticket',
            message: 'This is the second ticket',
            attachments: []
        );

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(__('tickets.error.ticket_daily_limit'));

        $this->ticketService->createTicket($secondTicketData);
    }

    public function test_creating_ticket_next_day_is_allowed(): void
    {
        Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDay(),
        ]);

        $ticketData = new TicketData(
            email: $this->customer->email,
            subject: 'New Day Ticket',
            message: 'Allowed ticket after yesterday',
            attachments: []
        );

        $ticket = $this->ticketService->createTicket($ticketData);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertEquals('New Day Ticket', $ticket->subject);
    }

    public function test_get_ticket_statistics_day(): void
    {
        $ticketToday = Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now(),
        ]);

        Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDay(),
        ]);

        $tickets = Ticket::byDate(Period::DAY)->get();

        $this->assertCount(1, $tickets);
        $this->assertTrue($tickets->first()->is($ticketToday));
    }

    public function test_get_ticket_statistics_week(): void
    {
        $ticket1 = Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDays(2),
        ]);
        $ticket2 = Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDays(5),
        ]);

        Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDays(10),
        ]);

        $tickets = Ticket::byDate(Period::WEEK)->get();

        $this->assertCount(2, $tickets);
        $this->assertTrue($tickets->contains($ticket1));
        $this->assertTrue($tickets->contains($ticket2));
    }

    public function test_get_ticket_statistics_month(): void
    {
        $ticket1 = Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDays(3),
        ]);

        $ticket2 = Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDays(15),
        ]);

        Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'created_at' => now()->subDays(40),
        ]);

        $tickets = Ticket::byDate(Period::MONTH)->get();

        $this->assertCount(2, $tickets);
        $this->assertTrue($tickets->contains($ticket1));
        $this->assertTrue($tickets->contains($ticket2));
    }

    public function test_update_ticket_status_enum(): void
    {
        $ticket = Ticket::factory()->create([
            'customer_id' => $this->customer->id,
            'status' => TicketStatus::NEW->value,
        ]);

        $this->assertEquals(TicketStatus::NEW->value, $ticket->status);

        $updatedTicket = $this->ticketService->updateTicketStatus(
            $ticket->id,
            TicketStatus::IN_PROGRESS->value
        );

        $this->assertInstanceOf(Ticket::class, $updatedTicket);

        $this->assertEquals(TicketStatus::IN_PROGRESS->value, $updatedTicket->status);

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => TicketStatus::IN_PROGRESS->value,
        ]);
    }
}
