<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'cozinha_id',
        'nome',
        'telefone',
    ];

    public function cozinha()
    {
        return $this->belongsTo(Cozinha::class);
    }
}
