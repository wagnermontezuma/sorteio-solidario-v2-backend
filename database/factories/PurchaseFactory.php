<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Raffle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Purchase>
 */
class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'raffle_id' => Raffle::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => 0,
            'status' => $this->faker->randomElement(['pending', 'paid', 'paid', 'paid']),
        ];
    }

    public function configure(): self
    {
        return $this->afterMaking(function (Purchase $purchase) {
            if ($purchase->total_price <= 0 && $purchase->relationLoaded('raffle')) {
                $purchase->total_price = $purchase->quantity * $purchase->raffle->ticket_price;
            }
        })->afterCreating(function (Purchase $purchase) {
            if ($purchase->total_price <= 0) {
                $raffle = $purchase->raffle()->first();
                if ($raffle) {
                    $purchase->total_price = $purchase->quantity * $raffle->ticket_price;
                    $purchase->save();
                }
            }
        });
    }

    public function paid(): self
    {
        return $this->state(fn () => ['status' => 'paid']);
    }

    public function pending(): self
    {
        return $this->state(fn () => ['status' => 'pending']);
    }
}
