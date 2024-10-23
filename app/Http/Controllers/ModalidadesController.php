<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModalidadeRequest;
use App\Models\Modalidades;
use Illuminate\Http\Request;

class ModalidadesController extends Controller
{
    /**
     * Mostra Todas Modalidades
     *
     * Endpoint para mostrar todas as modalidades disponíveis no sistema
     */
    public function index()
    {
        return response()->json(Modalidades::all());
    }

    /**
     * Cria Modalidade
     *
     * Endpoint para criar uma nova modalidade
     */
    public function store(ModalidadeRequest $request)
    {
        $modalidade = Modalidades::create($request->all());
        return response()->json($modalidade, 201);
    }

    /**
     * Mostra Modalidade
     *
     * Endpoint para mostrar a modalidade do id informado
     */
    public function show(Modalidades $modalidades)
    {
        return response()->json($modalidades);
    }

    /**
     * Atualiza modalidade
     *
     * Endpoint para atualizar a modalidade (único campo é o name)
     */
    public function update(Request $request, Modalidades $modalidades)
    {
        $modalidades->update($request->all());
        return response()->json($modalidades, 200);
    }

    /**
     * Apaga Modalidade
     *
     * Endpoint para apagar a modalidade informada
     */
    public function destroy(Modalidades $modalidades)
    {
        $modalidades->delete();
        return response()->json(null, 204);
    }
}
