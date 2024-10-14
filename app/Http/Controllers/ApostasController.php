<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApostaRequest;
use Illuminate\Http\Request;
use App\Models\Apostas;
use App\Models\Jogos;

class ApostasController extends Controller
{
    // Criar uma nova aposta
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

        $dados = $request->all();
        $dados['user_id'] = $user->id;

        // Definir o campo 'limite' como a data e hora do jogo
        $dados['limite'] = \Carbon\Carbon::parse($jogo->data_hora_jogo)->subMinute();

        // Definir o campo 'venceu' como false por padrão
        $dados['venceu'] = false;

        $aposta = Apostas::createAposta($dados);

        return response()->json($aposta, 201);
    }



    // Mostrar todas as apostas
    public function index()
    {
        $apostas = Apostas::listarApostas();
        return response()->json($apostas);
    }

    // Mostrar apostas que apostaram em quem seria o vencedor
    public function showVencedor($venceu)
    {
        $apostas = Apostas::listarApostasAcertaramVencedor($venceu);
        return response()->json($apostas);
    }

    // Mostrar apostas que acertaram o placar
    public function showPlacar($placarCasa, $placarVisitante)
    {
        $apostas = Apostas::listarApostasAcertaramPlacar($placarCasa, $placarVisitante);
        return response()->json($apostas);
    }

    // Atualizar o campo 'venceu' de uma aposta
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

    // Mostrar apostas do usuário autenticado
    public function showUserApostas(Request $request)
    {
        $userId = $request->user_id;
        $apostas = Apostas::where('user_id', $userId)->get();
        return response()->json($apostas);
    }
}
