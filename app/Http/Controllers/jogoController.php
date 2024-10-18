<?php

namespace App\Http\Controllers;

use App\Http\Requests\JogoRequest;
use App\Models\Jogos;
use App\Models\Apostas;
use Illuminate\Http\Request;

class jogoController extends Controller
{
    // Buscar todos os jogos
    public function getAllRecord(){
        $record = Jogos::all();

        return response()->json(['message'=> 'todos os jogos', 'data' => $record]);
    }

    // Registrar um novo jogo
    public function createRecord(JogoRequest $request){
        $data = $request->all();

        $jogos =  Jogos::create([
            'time_casa_id' => $data['time_casa_id'],
            'time_visitante_id' => $data['time_visitante_id'],
            'placar_casa' => null,
            'placar_visitante' => null,
            'data_hora_jogo' => $data['data_hora_jogo'],
            'modalidade_id' => $data['modalidade_id'],
            ]
        );
        return response()->json(['message'=>'inserido','account'=>$jogos]);
    }

    // Realizar o jogo
    public function realizarJogo(int $id){
        $jogo = Jogos::find($id);
        if (!$jogo) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        $placar_casa = rand(0, 5);
        $placar_visitante = rand(0, 5);
        $data_hora_atual = date('Y-m-d H:i:s');

        if ($jogo->data_hora_jogo <= $data_hora_atual && $jogo->placar_casa !== null && $jogo->placar_visitante !== null) {
            return response()->json(['message' => 'O jogo já ocorreu e possui placar registrado'], 400);
        }

        $jogo->update([
            'placar_casa' => $placar_casa,
            'placar_visitante' => $placar_visitante,
            'data_hora_jogo' => date('Y-m-d H:i:s'),
        ]);

        // Atualizar apostas que acertaram o placar exato
        Apostas::where('jogo_id', $id)
            ->where('placar_casa', $placar_casa)
            ->where('placar_visitante', $placar_visitante)
            ->update(['venceu' => true]);

        // Atualizar apostas que acertaram o time vencedor
        Apostas::where('jogo_id', $id)
            ->where(function($query) use ($placar_casa, $placar_visitante) {
            if ($placar_casa > $placar_visitante) {
                $query->where('resultado', 'C');
            } elseif ($placar_casa < $placar_visitante) {
                $query->where('resultado', 'V');
            } else {
                $query->where('resultado', 'E');
            }
            })
            ->update(['venceu' => true]);

        return response()->json(['message'=>'Jogo realizado', 'account'=>$jogo]);
    }

    // Ver resultado de jogo
    public function verResultadoDeJogo(int $id){
        $jogo = Jogos::where('id', '=', $id)->get();
        return response()->json($jogo);
    }

    // Editar jogo
    public function editRecord(JogoRequest $request,int $id) {
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

    // Deletar jogo
    public function deleteRecord(int $id) {
        $game =  Jogos::where('id', '=', $id )->delete();
        return response()->json(['message'=>'Deletado']);
    }

    // Mostrar jogos que ainda não começaram
    public function listarJogosQueAindaNaoComecaram(){
        $data_hora_atual = date('Y-m-d H:i:s');
        $jogosQueAindaNaoComecaram = Jogos::where('data_hora_jogo', '>', $data_hora_atual)->get();
        return response()->json($jogosQueAindaNaoComecaram);
    }

    // Mostrar jogos que já encerraram
    public function listarJogosQuePassaram(){
        $data_hora_atual = date('Y-m-d H:i:s');
        $jogosQuePassaram = Jogos::where('data_hora_jogo', '<=', $data_hora_atual)->get();
        return response()->json($jogosQuePassaram);
    }
}
