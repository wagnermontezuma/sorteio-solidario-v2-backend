<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cozinha extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'logo',
        'mapa',
        'equipe',
        'mapa_link',
        'resumo',
        'email',
    ];

    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }

    public function parceiros()
    {
        return $this->hasMany(Parceiro::class);
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }
}
