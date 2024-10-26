<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class timeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bragantino = Time::create([
            'name' => 'bragantino',
            'modalidades_id'=> 1,
            'escudo' => ''
        ]);
        $flamengo = Time::create([
            'name' => 'flamengo',
            'modalidades_id'=> 1,
            'escudo' => ''
        ]);
    }
}