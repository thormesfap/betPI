<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Modalidades extends Model
{

    use HasFactory;
    // Defina a tabela associada ao modelo, se necessário
    protected $table = 'modalidades';

    // Defina os atributos que podem ser atribuídos em massa
    protected $fillable = ['name'];

    public function times(): HasMany
    {
        return $this->hasMany(related: Time::class);
    }

    // public function jogos(): HasMany
    // {
    //     return $this->hasMany(related: Jogo::class);
    // }
}