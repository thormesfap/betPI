<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Time;
use App\Models\Modalidades;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtém a modalidade 'Futebol'
        $modalidade = Modalidades::where('name', 'Futebol')->first();

        // Verifica se a modalidade foi encontrada
        if (!$modalidade) {
            throw new \Exception('Modalidade "Futebol" não encontrada. Execute a seed ModalidadesTableSeeder primeiro.');
        }

        // Dados dos times
        $times = [
            [
                'name' => 'Cuiabá',
                'escudo' => 'https://logodetimes.com/times/cuiaba/logo-cuiaba-256.png',
            ],
            [
                'name' => 'Atlético Mineiro',
                'escudo' => 'https://logodetimes.com/times/atletico-mineiro/logo-atletico-mineiro-256.png',
            ],
            [
                'name' => 'Bahia',
                'escudo' => 'https://logodetimes.com/times/bahia/logo-bahia-256.png',
            ],
            [
                'name' => 'Botafogo',
                'escudo' => 'https://logodetimes.com/times/botafogo/logo-botafogo-256.png',
            ],
            [
                'name' => 'Corinthians',
                'escudo' => 'https://logodetimes.com/times/corinthians/logo-corinthians-256.png',
            ],
            [
                'name' => 'Cruzeiro',
                'escudo' => 'https://logodetimes.com/times/cruzeiro/logo-cruzeiro-256.png',
            ],
            [
                'name' => 'Flamengo',
                'escudo' => 'https://logodetimes.com/times/flamengo/logo-flamengo-256.png',
            ],
            [
                'name' => 'Fluminense',
                'escudo' => 'https://logodetimes.com/times/fluminense/logo-fluminense-256.png',
            ],
            [
                'name' => 'Fortaleza',
                'escudo' => 'https://logodetimes.com/times/fortaleza/logo-fortaleza-256.png',
            ],
            [
                'name' => 'Grêmio',
                'escudo' => 'https://logodetimes.com/times/gremio/logo-gremio-256.png',
            ],
            [
                'name' => 'Internacional',
                'escudo' => 'https://logodetimes.com/times/internacional/logo-internacional-256.png',
            ],
            [
                'name' => 'Palmeiras',
                'escudo' => 'https://logodetimes.com/times/palmeiras/logo-palmeiras-256.png',
            ],
            [
                'name' => 'Santos',
                'escudo' => 'https://logodetimes.com/times/santos/logo-santos-256.png',
            ],
            [
                'name' => 'São Paulo',
                'escudo' => 'https://logodetimes.com/times/sao-paulo/logo-sao-paulo-256.png',
            ],
            [
                'name' => 'Vasco da Gama',
                'escudo' => 'https://logodetimes.com/times/vasco-da-gama/logo-vasco-da-gama-256.png',
            ],
            [
                'name' => 'América Mineiro',
                'escudo' => 'https://logodetimes.com/times/america-mineiro/logo-america-mineiro-256.png',
            ],
            [
                'name' => 'Athletico Paranaense',
                'escudo' => 'https://logodetimes.com/times/athletico-paranaense/logo-athletico-paranaense-256.png',
            ],
            [
                'name' => 'Avaí',
                'escudo' => 'https://logodetimes.com/times/avai/logo-avai-256.png',
            ],
            [
                'name' => 'Bragantino',
                'escudo' => 'https://logodetimes.com/times/bragantino/logo-bragantino-256.png',
            ],
            [
                'name' => 'Chapecoense',
                'escudo' => 'https://logodetimes.com/times/chapecoense/logo-chapecoense-256.png',
            ],
            [
                'name' => 'Coritiba',
                'escudo' => 'https://logodetimes.com/times/coritiba/logo-coritiba-256.png',
            ],
            [
                'name' => 'CSA',
                'escudo' => 'https://logodetimes.com/times/csa/logo-csa-256.png',
            ],
            [
                'name' => 'Ceará',
                'escudo' => 'https://logodetimes.com/times/ceara/logo-ceara-256.png',
            ],
            [
                'name' => 'Figueirense',
                'escudo' => 'https://logodetimes.com/times/figueirense/logo-figueirense-256.png',
            ],
            [
                'name' => 'Goiás',
                'escudo' => 'https://logodetimes.com/times/goias/logo-goias-256.png',
            ],
            [
                'name' => 'Guarani',
                'escudo' => 'https://logodetimes.com/times/guarani/logo-guarani-256.png',
            ],
            [
                'name' => 'Juventude',
                'escudo' => 'https://logodetimes.com/times/juventude/logo-juventude-256.png',
            ],
            [
                'name' => 'Londrina',
                'escudo' => 'https://logodetimes.com/times/londrina/logo-londrina-256.png',
            ],
            [
                'name' => 'Náutico',
                'escudo' => 'https://logodetimes.com/times/nautico/logo-nautico-256.png',
            ],
            [
                'name' => 'Operário',
                'escudo' => 'https://logodetimes.com/times/operario/logo-operario-256.png',
            ],
            [
                'name' => 'Paraná',
                'escudo' => 'https://logodetimes.com/times/parana/logo-parana-256.png',
            ],
            [
                'name' => 'Ponte Preta',
                'escudo' => 'https://logodetimes.com/times/ponte-preta/logo-ponte-preta-256.png',
            ],
            [
                'name' => 'Sampaio Corrêa',
                'escudo' => 'https://logodetimes.com/times/sampaio-correa/logo-sampaio-correa-256.png',
            ],
            [
                'name' => 'Sport',
                'escudo' => 'https://logodetimes.com/times/sport/logo-sport-256.png',
            ],
            [
                'name' => 'Vila Nova',
                'escudo' => 'https://logodetimes.com/times/vila-nova/logo-vila-nova-256.png',
            ],
            [
                'name' => 'Vitória',
                'escudo' => 'https://logodetimes.com/times/vitoria/logo-vitoria-256.png',
            ],
        ];
        
        // Cria os times no banco de dados e associa com a modalidade 'Futebol'
        foreach ($times as $time) {
            $newTime = new Time();
            $newTime->fill($time);
            $newTime->modalidades()->associate($modalidade);
            $newTime->save();
        }
    }
}