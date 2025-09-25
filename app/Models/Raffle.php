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
        'status',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'draw_date' => 'datetime',
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
