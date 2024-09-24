<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public function modalidade(): BelongsTo{
        return $this->belongsTo(Modalidade::class);
    }
}
