<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Time extends Model
{
    use HasFactory;

    protected $table = 'times';


    protected $fillable = [
        'name',
        'modalidades_id',
        'escudo',
    ];

    public function modalidades(): BelongsTo{
        return $this->belongsTo(Modalidades::class);
    }
    protected $guarded = [];

}