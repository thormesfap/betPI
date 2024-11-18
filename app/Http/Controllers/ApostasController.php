<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApostaRequest;
use Illuminate\Http\Request;
use App\Models\Apostas;
use App\Models\Jogos;
use Illuminate\Support\Facades\Auth;

class ApostasController extends Controller
{
    /**
     * Criar uma nova aposta
     */
    public function store(ApostaRequest $request)
    {
        // Buscar a data e hora do jogo
        $jogo = Jogos::find($request->input('jogo_id'));
        if (!$jogo) {
            return response()->json(['message' => 'Jogo não encontrado'], 404);
        }
        $user = auth('api')->user();

        // Verificar se o jogo já aconteceu
        if (\Carbon\Carbon::parse($jogo->data_hora_jogo)->isPast()) {
            return response()->json(['message' => 'Não é possível apostar em um jogo que já aconteceu'], 400);
        }

        // $dados = $request->validate([
        //     'jogo_id' => 'required|integer',
        //     'placar_casa' => 'nullable|integer',
        //     'placar_visitante' => 'nullable|integer',
        //     'resultado' => 'required|string|in:C,V,E', // Validar valores permitidos
        //     'valor' => 'required|numeric',
        // ]);
        $dados = $request->all();
        $dados['user_id'] = Auth::user()->id;

        // Definir o campo 'limite' como a data e hora do jogo
        $dados['limite'] = \Carbon\Carbon::parse($jogo->data_hora_jogo)->subMinute();

        // Definir o campo 'venceu' como false por padrão
        $dados['venceu'] = false;

        $aposta = Apostas::createAposta($dados);

        return response()->json($aposta, 201);
    }


    /**
     * Mostrar todas as apostas
     *
     * Endpoint que traz a informação de todas as apostas realizadas. Precisa de perfil Admin
     */
    public function index()
    {
        $apostas = Apostas::listarApostas();
        return response()->json($apostas);
    }

    /**
     * Mostrar apostas de resultado
     *
     * Endpoint para mostrar todas as apostas que foram feitas com base em resultado, e acertaram o vencedor. Precisa de perfil Admin
     *
     */
    public function showVencedor($venceu)
    {
        $apostas = Apostas::listarApostasAcertaramVencedor($venceu);
        return response()->json($apostas);
    }

    /**
     * Mostrar apostas de placar
     *
     * Endpoint para mostrar todas as apostas que foram feitas com base em placar, e acertaram qual seria o placar. Precisa de perfil Admin
     */
    public function showPlacar($placarCasa, $placarVisitante)
    {
        $apostas = Apostas::listarApostasAcertaramPlacar($placarCasa, $placarVisitante);
        return response()->json($apostas);
    }

    /**
     * Atualizar o campo 'venceu' de uma aposta
     *
     * Endpoint para atualizar o status de 'venceu' da aposta. Precisa de perfil Admin
     */

    public function updateVenceu(Request $request, $id)
    {
        $dados = $request->validate([
            'venceu' => 'required|boolean',
        ]);

        $aposta = Apostas::find($id);
        if ($aposta) {
            $aposta->venceu = $dados['venceu'];
            $aposta->save();
            return response()->json($aposta);
        }
        return response()->json(['message' => 'Aposta não encontrada'], 404);
    }

    /**
     * Mostrar apostas do usuário autenticado
     *
     * Mostra as apostas feitas pelo usuário que estiver autenticado
     */
    public function ver_minhas_apostas(Request $request)
    {
        $user = auth('api')->user();
        $apostas = Apostas::where('user_id', $user->id)->get();
        return response()->json($apostas);
    }
}
