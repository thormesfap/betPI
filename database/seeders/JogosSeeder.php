<?php

namespace Database\Seeders;

use App\Models\Modalidades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Time;
use App\Models\Jogos;

class JogosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtém a modalidade 'Futebol'
        $modalidade = Modalidades::where('name', 'Futebol')->first();

        // Verifica se a modalidade foi encontrada
        if (!$modalidade) {
            throw new \Exception('Modalidade "Futebol" não encontrada. Execute a seed ModalidadesTableSeeder primeiro.');
        }
        $times = Time::where('modalidades_id', $modalidade->id)->get();
        $inicio = new \DateTime("2024-11-28 18:30");
        $fim = new \DateTime("2024-11-28 21:30");
        while ($inicio <= $fim){
            $jogo = new Jogos();
            $jogo->modalidade_id = $modalidade->id;

            $timeCasa = $times[rand(0, count($times) - 1)];
            $timeVisitante = $times[rand(0, count($times) - 1)];
            
            while($timeCasa->id == $timeVisitante->id){
                $timeVisitante = $times[rand(0, count($times))];
            }
            $jogo->data_hora_jogo = $inicio;
            $jogo->timeCasa()->associate($timeCasa);
            $jogo->timeVisitante()->associate($timeVisitante);
            $jogo->save();
            $inicio->add(new \DateInterval("PT1M"));
        }
        
    }
}