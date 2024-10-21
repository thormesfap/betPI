<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modalidades;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $modalidades = [
            ['name' => 'Futebol'],
            ['name' => 'Basquete'],
            ['name' => 'Vôlei'],
            ['name' => 'Handebol'],
            ['name' => 'Tênis'],

            // Adicione mais modalidades conforme necessário
        ];

        foreach ($modalidades as $modalidade) {
            Modalidades::create( $modalidade);
        }
    }
}