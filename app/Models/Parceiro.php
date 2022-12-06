<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parceiro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cozinha_id',
        'nome',
        'logo',
    ];
}
