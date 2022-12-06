<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receita extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cozinha_id',
        'categoria_id',
        'nome',
        'imagem',
        'tempo_preparo',
        'num_porcoes',
        'peso_porcao',
        'ingredientes',
        'utensilios_necessarios',
        'modo_preparo',
        'tabela_nutricional',
        'destaque',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->withTrashed();
    }

    public function cozinha()
    {
        return $this->belongsTo(Cozinha::class)->withTrashed();
    }
}
