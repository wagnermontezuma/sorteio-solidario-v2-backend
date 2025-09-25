<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Raffle;
use App\Models\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaffleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE TABLE tickets RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE purchases RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE customers RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE raffles RESTART IDENTITY CASCADE');

        fake()->unique(true);

        Raffle::factory()
            ->count(5)
            ->create()
            ->each(function (Raffle $raffle) {
                $faker = fake();

                $availableNumbers = collect(range(1, $raffle->total_tickets))->shuffle();
                $soldTicketsGoal = (int) floor($raffle->total_tickets * $faker->randomFloat(2, 0.25, 0.6));
                $soldTickets = 0;

                while ($soldTickets < $soldTicketsGoal && $availableNumbers->isNotEmpty()) {
                    $quantity = min(
                        $faker->numberBetween(1, 8),
                        $soldTicketsGoal - $soldTickets,
                        $availableNumbers->count()
                    );

                    $customer = Customer::factory()->create();

                    $purchase = Purchase::factory()
                        ->for($customer)
                        ->for($raffle)
                        ->paid()
                        ->create([
                            'quantity' => $quantity,
                            'total_price' => $quantity * $raffle->ticket_price,
                        ]);

                    for ($i = 0; $i < $quantity; $i++) {
                        $number = str_pad((string) $availableNumbers->pop(), 5, '0', STR_PAD_LEFT);

                        Ticket::factory()
                            ->for($purchase)
                            ->for($raffle)
                            ->paid()
                            ->create([
                                'number' => $number,
                            ]);
                    }

                    $soldTickets += $quantity;
                }

                if ($faker->boolean(60)) {
                    $pendingQuantity = $faker->numberBetween(1, 5);
                    $customer = Customer::factory()->create();

                    Purchase::factory()
                        ->for($customer)
                        ->for($raffle)
                        ->pending()
                        ->create([
                            'quantity' => $pendingQuantity,
                            'total_price' => $pendingQuantity * $raffle->ticket_price,
                        ]);
                }

                if ($raffle->status === 'completed') {
                    $raffle->updateQuietly([
                        'draw_date' => now()->subDays(2),
                    ]);
                }
            });
    }
}