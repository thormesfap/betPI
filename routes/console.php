<?php

use App\Models\Apostas;
use App\Models\Jogos;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

\Illuminate\Support\Facades\Schedule::call(function () {
    echo "Iniciando finalização de jogos";
    $agora = new \DateTime();
    $passados = Jogos::where('data_hora_jogo', '<=', $agora)->whereNull('placar_casa')->whereNull('placar_visitante')->orderBy('data_hora_jogo')->get();
    if ($passados->isEmpty()) {
        return;
    }

    //Atualiza todos os jogos que já aconteceram e não possuem placar
    foreach ($passados as $jogo) {
        $placar_casa = rand(0, 5);
        $placar_visitante = rand(0, 5);
        $jogo->update([
            'placar_casa' => $placar_casa,
            'placar_visitante' => $placar_visitante,
        ]);
        $jogo->save();
        // Atualizar apostas que acertaram o placar exato
        Apostas::where('jogo_id', $jogo->id)
            ->andWhere('placar_casa', $placar_casa)
            ->andWhere('placar_visitante', $placar_visitante)
            ->update(['venceu' => true]);

        // Atualizar apostas que acertaram o time vencedor
        Apostas::where('jogo_id', $jogo->id)
            ->where(function ($query) use ($placar_casa, $placar_visitante) {
                if ($placar_casa > $placar_visitante) {
                    $query->where('resultado', 'C');
                } elseif ($placar_casa < $placar_visitante) {
                    $query->where('resultado', 'V');
                } else {
                    $query->where('resultado', 'E');
                }
            })
            ->update(['venceu' => true]);
    }
})->everyThirtySeconds();
