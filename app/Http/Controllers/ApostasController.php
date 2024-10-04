<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apostas;

class ApostasController extends Controller
{
    // Criar uma nova aposta
    public function store(Request $request)
    {
        $dados = $request->validate([
            'user_id' => 'required|integer',
            'jogo_id' => 'required|integer',
            'placar_casa' => 'nullable|integer',
            'placar_visitante' => 'nullable|integer',
            'resultado' => 'required|string|in:C,V,E', // Validar valores permitidos
            'valor' => 'required|numeric',
            'limite' => 'required|date',
        ]);

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
    
}