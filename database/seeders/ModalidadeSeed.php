<?php

namespace Database\Seeders;

use App\Models\Modalidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $futebol = Modalidade::create([
            'name' => 'futebol'
        ]);
    }
}
