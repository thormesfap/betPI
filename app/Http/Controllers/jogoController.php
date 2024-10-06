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
        $data = $request->all();

        $jogos =  Jogos::create([
            'time_casa_id' => $data['time_casa_id'],
            'time_visitante_id' => $data['time_visitante_id'],
            'placar_casa' => $data['placar_casa'],
            'placar_visitante' => $data['placar_visitante'],
            'data_hora_jogo' => $data['data_hora_jogo'],
            'modalidade_id' => $data['modalidade_id'],
            ]
        );
        return response()->json(['message'=>'inserido','account'=>$jogos]);
    }
    public function editRecord(Request $request,int $id) {
        $game =  Jogos::where('id','=',$id)->update([
            'time_casa_id' => $request['time_casa_id'],
            'time_visitante_id' => $request['time_visitante_id'],
            'placar_casa' => $request['placar_casa'],
            'placar_visitante' => $request['placar_visitante'],
            'data_hora_jogo' => $request['data_hora_jogo'],
            'modalidade_id' => $request['modalidade_id'],
            ]);
        return response()->json(['message'=>'atualizado', 'account'=>$game]);
    }
    public function deleteRecord(int $id) {
        $game =  Jogos::where('id', '=', $id )->delete();
        return response()->json(['message'=>'Deletado']);
    }
}
