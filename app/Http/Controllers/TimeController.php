<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Models\Modalidades;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Cria um novo time.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'modalidades_id' => 'required|integer|exists:modalidades,id',
            'escudo' => 'nullable|string|max:255',
        ]);

        $time = Time::createTime($data);

        return response()->json($time, 201);
    }

    /**
     * Atualiza um time existente.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'modalidades_id' => 'sometimes|required|integer|exists:modalidades,id',
            'escudo' => 'nullable|string|max:255',
        ]);

        $time = Time::findOrFail($id);
        $time->alterarTime($data);

        return response()->json($time);
    }

    /**
     * Busca times pelos atributos fornecidos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $attributes = $request->only(['name', 'modalidades_id', 'escudo']);
        $times = Time::searchTimes($attributes);

        return response()->json($times);
    }

    /**
     * Deleta um time (soft delete).
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $time = Time::findOrFail($id);
        $time->deleteTime();

        return response()->json(['message' => 'Time deletado com sucesso.']);
    }

    public function buscarModalidades()
    {
        $modalidades = Modalidades::all();

        return response()->json($modalidades);
    }
}