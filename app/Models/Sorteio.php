<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sorteio extends Raffle
{
    use HasFactory;

    /**
     * Nome da tabela para o model Sorteio (mapeia para 'raffles').
     */
    protected $table = 'raffles';
}
