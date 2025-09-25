<?php

namespace Database\Factories;

use App\Models\Raffle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Raffle>
 */
class RaffleFactory extends Factory
{
    protected $model = Raffle::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        $ticketPrice = $this->faker->randomFloat(2, 5, 100);

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(6)),
            'description' => $this->faker->paragraphs(3, true),
            'rules' => implode("\n", $this->faker->sentences(4)),
            'image_url' => sprintf('https://picsum.photos/seed/%s/800/600', Str::random(8)),
            'gallery_images' => [
                sprintf('https://picsum.photos/seed/%s/800/600', Str::random(8)),
                sprintf('https://picsum.photos/seed/%s/800/600', Str::random(8)),
                sprintf('https://picsum.photos/seed/%s/800/600', Str::random(8)),
            ],
            'ticket_price' => $ticketPrice,
            'total_tickets' => $this->faker->numberBetween(300, 1500),
            'draw_date' => $this->faker->dateTimeBetween('+5 days', '+90 days'),
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'completed']),
        ];
    }

    public function completed(): self
    {
        return $this->state(fn () => [
            'status' => 'completed',
            'draw_date' => $this->faker->dateTimeBetween('-30 days', '-1 day'),
        ]);
    }
}
