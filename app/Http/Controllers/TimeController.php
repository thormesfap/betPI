<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRequest;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{

    /**
     * Mostrar todos os times
     *
     * Endpoint que mostra todos os times cadastrados. Precisa de perfil Admin
     */
    public function getAllRecord(){
        $record = Time::all();

        return response()->json(['message'=> 'todos os times', 'data' => $record]);
    }

    /**
     * Mostrar o time do Id
     *
     * Endpoint que mostra o time identificado. Precisa de perfil Admin
     */
    public function getRecord(int $id){
        $record = Time::where('id','=',$id)->get();

        return response()->json(['message'=> 'pega um time especifico', 'data' => $record]);
    }

    /**
     * Cria Time
     *
     * Endpoint para criação de um time. Precisa de perfil Admin
     */
    public function createRecord(TimeRequest $request){
        $data = $request->all();

        $record =  Time::create([
                'name'=> $request->name,
                'modalidades_id'=> $request->modalidade_id,
                'escudo'=> $request->escudo
                ]
        );
        return response()->json(['message'=>'inserido','account'=>$record]);
    }

    /**
     * Editar Time
     *
     * Endpoint para atualizar os dados de um time. Precisa de perfil Admin
     */
    public function editRecord(TimeRequest $request,int $id) {
        $record =  Time::where('id','=',$id)->update([
            'name'=> $request->name,
            'modalidades_id'=> $request->modalidade_id,
            'escudo'=> $request->escudo
            ]);
        return response()->json(['message'=>'atualizado', 'account'=>$record]);
    }

    /**
     * Apagar Time
     *
     * Endpoint que apagar um time. Precisa de perfil Admin
     */
    public function deleteRecord(int $id) {
        $record =  Time::where('id', '=', $id )->delete();
        return response()->json(['message'=>'Deletado']);
    }
}
