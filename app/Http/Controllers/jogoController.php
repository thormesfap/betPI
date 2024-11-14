<?php

namespace App\Http\Controllers;

use App\Http\Requests\JogoRequest;
use App\Models\Jogos;
use App\Models\Apostas;
use Illuminate\Http\Request;

class jogoController extends Controller
{
    /**
     * Mostrar todos os jogos
     *
     * Endpoint que mostra todos os jogos cadastrados. Precisa de perfil Admin
     */
    public function getAllRecord(){
        $record = Jogos::all()->orderBy('data_hora_jogo');

        return response()->json($record);
    }

    /**
     * Cria Novo Jogo
     *
     * Endpoint para criação de um jogo. Precisa de perfil Admin
     */
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
        return response()->json($jogos);
    }

    /**
     * Realizar Jogo
     *
     * Endpoint que simula o resultado e placar de um jogo, marcando-o como realizado. Precisa de perfil Admin
     */
    public function realizarJogo(int $id){
        $jogo = Jogos::find($id);
        if (!$jogo) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }

        $placar_casa = rand(0, 5);
        $placar_visitante = rand(0, 5);
        $data_hora_atual = date('Y-m-d H:i:s');

        if ($jogo->data_hora_jogo <= $data_hora_atual && $jogo->placar_casa !== null && $jogo->placar_visitante !== null) {
            return response()->json('O jogo já ocorreu e possui placar registrado', 400);
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

        return response()->json($jogo);
    }

    /**
     * Ver Resultado
     *
     * Endpoint que mostra o resultado de um jogo. Precisa ser usuário logado
     */
    public function verResultadoDeJogo(int $id){
        $jogo = Jogos::where('id', '=', $id)->get();
        return response()->json($jogo);
    }

    /**
     * Atualizar Jogo
     *
     * Endpoint que mostra todos os times cadastrados. Precisa de perfil Admin
     */
    public function editRecord(JogoRequest $request,int $id) {
        $game =  Jogos::where('id','=',$id)->update([
            'time_casa_id' => $request['time_casa_id'],
            'time_visitante_id' => $request['time_visitante_id'],
            'placar_casa' => $request['placar_casa'],
            'placar_visitante' => $request['placar_visitante'],
            'data_hora_jogo' => $request['data_hora_jogo'],
            'modalidade_id' => $request['modalidade_id'],
            ]);
        return response()->json($game);
    }

    /**
     * Apagar Jogo
     *
     * Endpoint para apagar um jogo. Precisa de perfil Admin
     */
    public function deleteRecord(int $id) {
        $game =  Jogos::where('id', '=', $id )->delete();
        return response()->json($game);
    }
    /**
     * Mostrar Jogos Pendentes
     *
     * Endpoint que mostra os jogos que ainda não foram realizados. Precisa estar logado
     */
    public function listarJogosQueAindaNaoComecaram(){
        $data_hora_atual = date('Y-m-d H:i:s');
        $jogosQueAindaNaoComecaram = Jogos::where('data_hora_jogo', '>', $data_hora_atual)->orderBy('data_hora_jogo')->get();
        return response()->json($jogosQueAindaNaoComecaram);
    }

    /**
     * Mostrar Jogos Passados
     *
     * Endpoint que mostra os jogos que já foram realizados. Precisa de perfil Admin
     */
    public function listarJogosQuePassaram(){
        $data_hora_atual = date('Y-m-d H:i:s');
        $jogosQuePassaram = Jogos::where('data_hora_jogo', '<=', $data_hora_atual)->orderBy('data_hora_jogo')->get();
        return response()->json($jogosQuePassaram);
    }
}
