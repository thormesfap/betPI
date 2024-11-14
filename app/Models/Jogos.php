<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jogos extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['timeCasa', 'timeVisitante'];

    public function apostas(): HasMany{
        return $this->hasMany(Apostas::class);
    }
    public function timeCasa(): BelongsTo{
        return $this->belongsTo(Time::class, 'time_casa_id');
    }
    public function timeVisitante(): BelongsTo{
        return $this->belongsTo(Time::class, 'time_visitante_id');
    }
}
