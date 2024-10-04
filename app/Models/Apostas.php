<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apostas extends Model
{
    use HasFactory;

    protected $table = 'apostas';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'jogo_id',
        'placar_casa',
        'placar_visitante',
        'resultado',
        'venceu',
        'valor',
        'limite',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Criar uma nova aposta
    public static function createAposta($data)
    {
        // Validar valores permitidos para 'resultado'
        if (!in_array($data['resultado'], ['C', 'V', 'E'])) {
            throw new \InvalidArgumentException('Valor inválido para o campo resultado.');
        }

        return self::create($data);
    }

    // Listar todas as apostas realizadas
    public static function listarApostas()
    {
        return self::all();
    }

    // Listar apostas que tiveram o mesmo resultado do resultado do jogo
    public static function listarApostasMesmoResultado($resultado)
    {
        return self::where('resultado', $resultado)->get();
    }

    // Listar apostas que acertaram o placar
    public static function listarApostasAcertaramPlacar($placarCasa, $placarVisitante)
    {
        return self::where('placar_casa', $placarCasa)
                    ->where('placar_visitante', $placarVisitante)
                    ->get();
    }

    // Listar apostas que acertaram apenas o vencedor
    public static function listarApostasAcertaramVencedor($venceu)
    {
        return self::where('venceu', $venceu)->get();
    }
}