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

    /**
     * Atualiza o time.
     *
     * @param array $data
     * @return bool
     */
    public function alterarTime(array $data): bool
    {
        return $this->update($data);
    }

    /**
     * Procura o time pelos atributos da classe.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function buscarTimes(array $attributes)
    {
        $query = self::query();

        foreach ($attributes as $key => $value) {
            $query->where($key, $value);
        }

        return $query->get();
    }
    
    /**
     * Busca e lista os times pelo nome da modalidade.
     *
     * @param string $modalidadeNome
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function buscarTimesPorNomeModalidades(string $modalidadesNome)
    {
        return self::whereHas(relation: 'modalidades', callback: function ($query) use ($modalidadesNome): void {
            $query->where('name', $modalidadesNome);
        })->get();
    }

    public function modalidades(): BelongsTo{
        return $this->belongsTo(Modalidades::class);
    }


}