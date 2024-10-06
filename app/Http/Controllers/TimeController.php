<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function getAllRecord(){
        $record = Time::all();

        return response()->json(['message'=> 'todos os times', 'data' => $record]);
    }
    public function getRecord(int $id){
        $record = Time::where('id','=',$id)->get();

        return response()->json(['message'=> 'pega um time especifico', 'data' => $record]);
    }
    public function createRecord(Request $request){
        $data = $request->all();

        $record =  Time::create([
                'name'=> $request->name,
                'modalidades_id'=> $request->modalidade_id,
                'escudo'=> $request->escudo
                ]
        );
        return response()->json(['message'=>'inserido','account'=>$record]);
    }
    public function editRecord(Request $request,int $id) {
        $record =  Time::where('id','=',$id)->update([
            'name'=> $request->name,
            'modalidades_id'=> $request->modalidade_id,
            'escudo'=> $request->escudo
            ]);
        return response()->json(['message'=>'atualizado', 'account'=>$record]);
    }
    public function deleteRecord(int $id) {
        $record =  Time::where('id', '=', $id )->delete();
        return response()->json(['message'=>'Deletado']);
    }
}
