<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Time;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $times = [
            [
                'name' => 'Goias',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/goias/logo-goias-esporte-clube-256.png',
            ],
            [
                'name' => 'Santos',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/santos/logo-santos-256.png',
            ],
            [
                'name' => 'Fortaleza',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/fortaleza/logo-fortaleza-256.png',
            ],
            [
                'name' => 'Flamengo',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/flamengo/logo-flamengo-256.png',
            ],
            [
                'name' => 'Palmeiras',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/palmeiras/logo-palmeiras-256.png',
            ],
            [
                'name' => 'Internacional',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/internacional/logo-internacional-256.png',
            ],
            [
                'name' => 'Corinthians',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/corinthians/logo-corinthians-256.png',
            ],
            [
                'name' => 'São Paulo',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/sao-paulo/logo-sao-paulo-256.png',
            ],
            [
                'name' => 'Ceará',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/ceara/logo-ceara-256.png',
            ],
            [   
                'name' => 'Athletico Paranaense',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/athletico-paranaense/logo-athletico-paranaense-256.png',
            ],
            [
                'name' => 'Atlético Mineiro',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/atletico-mineiro/logo-atletico-mineiro-256.png',
            ],
            [
                'name' => 'Bahia',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/bahia/logo-bahia-256.png',
            ],
            [
                'name' => 'Fluminense',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/fluminense/logo-fluminense-256.png',
            ],
            [
                'name' => 'Grêmio',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/gremio/logo-gremio-256.png',
            ],
            [
                'name' => 'Sport',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/sport/logo-sport-256.png',
            ],
            [
                'name' => 'Vasco da Gama',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/vasco-da-gama/logo-vasco-da-gama-256.png',
            ],
            [
                'name' => 'Botafogo',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/botafogo/logo-botafogo-256.png',
            ],
            [
                'name' => 'Coritiba',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/coritiba/logo-coritiba-256.png',
            ],
            [
                'name' => 'Atlético Goianiense',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/atletico-goianiense/logo-atletico-goianiense-256.png',
            ],
            [
                'name' => 'Bragantino',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/bragantino/logo-bragantino-256.png',
            ],
            [
                'name' => 'Cuiabá',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/cuiaba/logo-cuiaba-256.png',
            ],
            [
                'name' => 'Juventude',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/juventude/logo-juventude-256.png',
            ],
            [   
                'name' => 'América Mineiro',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/america-mineiro/logo-america-mineiro-256.png',
            ],
            [
                'name' => 'Avaí',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/avai/logo-avai-256.png',
            ],
            [
                'name' => 'Chapecoense',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/chapecoense/logo-chapecoense-256.png',
            ],
            [
                'name' => 'Ponte Preta',
                'modalidades_id' => 1,
                'escudo' => 'https://logodetimes.com/times/ponte-preta/logo-ponte-preta-256.png',
            ]
        ];

        foreach ($times as $time) {
            Time::create(time: $time);
        }
    }
}