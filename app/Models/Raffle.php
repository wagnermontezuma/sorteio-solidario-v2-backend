<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'rules',
        'image_url',
        'gallery_images',
        'ticket_price',
        'total_tickets',
        'draw_date',
        'federal_lottery_contest',
        'federal_lottery_result',
        'winning_ticket_number',
        'result_published_at',
        'status',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'draw_date' => 'datetime',
        'result_published_at' => 'datetime',
        'ticket_price' => 'decimal:2',
        'total_tickets' => 'integer',
    ];

    protected $attributes = [
        'gallery_images' => '[]',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
