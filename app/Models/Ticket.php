<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Period;
use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property int $customer_id
 * @property string $subject
 * @property string $message
 * @property string|null $status
 * @property ?Carbon $answered_at
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 *
 * @property-read Customer $customer
 * @property-read Collection|File[] $files
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subject',
        'message',
        'status',
        'answered_at',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function scopeByDate(Builder $query, Period|string $period): Builder
    {
        $now = Carbon::now();
        $day = $now->toDateString();
        $weekAgo = $now->copy()->subWeek()->toDateString();
        $monthAgo = $now->copy()->subMonth()->toDateString();

        $periodEnum = is_string($period) ? Period::from($period) : $period;

        return match ($periodEnum) {
            Period::DAY => $query->whereDate('created_at', $day),
            Period::WEEK => $query->whereBetween('created_at', [
                $weekAgo,
                $now,
            ]),
            Period::MONTH => $query->whereBetween('created_at', [
                $monthAgo,
                $now,
            ]),
        };
    }

    protected static function newFactory(): TicketFactory
    {
        return TicketFactory::new();
    }
}
