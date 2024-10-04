<?php

namespace App\Http\Controllers;

use App\Models\Jogos;
use Illuminate\Http\Request;

class jogoController extends Controller
{
    public function getAllRecord(){
        $record = Jogos::all();

        return response()->json(['message'=> 'todos os jogos', 'data' => $record]);
    }
    public function createRecord(Request $request){
        $data = $request;
        $jogos =  Jogos::create([
            'time_casa_id' => $data->time_casa_id,
            'time_visitante_id' => $data->time_visitante_id,
            'placar_casa' => $data->placar_casa,
            'placar_visitante' => $data->placar_visitante,
            'data_hora_jogo' => $data->data_hora_jogo
            ]
        );
        return response()->json(['message'=>'inserido','account'=>$jogos]);
    }
}
