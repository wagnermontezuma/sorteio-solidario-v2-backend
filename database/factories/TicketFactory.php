<?php

namespace Database\Factories;

use App\Models\Purchase;
use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'purchase_id' => Purchase::factory(),
            'raffle_id' => Raffle::factory(),
            'number' => str_pad((string) $this->faker->numberBetween(0, 99999), 5, '0', STR_PAD_LEFT),
            'status' => $this->faker->randomElement(['paid', 'reserved', 'available']),
        ];
    }

    public function paid(): self
    {
        return $this->state(fn () => ['status' => 'paid']);
    }
}
