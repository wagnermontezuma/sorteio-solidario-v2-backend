<?php

namespace App\Http\Resources;

use App\Models\Raffle;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Raffle */
class RaffleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        $soldTickets = (int) ($this->resource->sold_tickets_count ?? $this->tickets()->where('status', 'paid')->count());

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->name,
            'description' => $this->description,
            'rules' => $this->rules,
            'prize' => $this->prize,
            'prize_image' => $this->image_url,
            'prize_images' => $this->gallery_images ?? [],
            'ticket_price' => (float) $this->ticket_price,
            'total_tickets' => (int) $this->total_tickets,
            'sold_tickets' => $soldTickets,
            'draw_date' => optional($this->draw_date)->toIso8601String(),
            'federal_lottery_contest' => $this->federal_lottery_contest,
            'federal_lottery_result' => $this->federal_lottery_result,
            'winning_ticket_number' => $this->winning_ticket_number,
            'result_published_at' => optional($this->result_published_at)->toIso8601String(),
            'status' => $this->mapStatus($this->status),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }

    private function mapStatus(?string $status): string
    {
        return match ($status) {
            'open', 'active', null => 'active',
            'closed', 'finished' => 'completed',
            'cancelled', 'canceled' => 'cancelled',
            default => $status,
        };
    }
}
