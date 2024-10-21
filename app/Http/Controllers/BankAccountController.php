<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Bank_Account;

class BankAccountController extends Controller
{
    /**
     * Conta do Usuário
     *
     * Endpoint para trazer a conta bancária do usuário informado. Precisa estar logado
     */
    public function Account_of_User(int $user_id): JsonResponse{
        $bank_accounts =  Bank_Account::where('user_id', '=', $user_id )->get();
        return response()->json(['message'=>'hello','account'=>$bank_accounts]);
    }

    /**
     * Criar Conta
     *
     * Endpoint para criação de conta bancária para o usuário. Precisa estar logado
     */
    public function createRecord(Request $request): JsonResponse{
        $data = $request;
        $bank_accounts =  Bank_Account::where('user_id', '=', $data->user_id )->get();
        if($bank_accounts){
            return response()->json(['message'=>'Usuario ja Tem conta!']);
        }else{
            $bank_accounts =  Bank_Account::create([
                'user_id' => $data->user_id,
                'account_number' => $data->account_number,
                'account_digit' => $data->account_digit,
                'account_holder_name' => $data->account_holder_name,
                'branch_code' => $data->branch_code,
                'bank_code' => $data->bank_code
                ]
            );
            return response()->json(['message'=>'inserido','account'=>$bank_accounts,'request' => $request]);
        }

    }

    /**
     * Editar Conta
     *
     * Endpoint para atualização de dados da conta bancária para o usuário. Precisa estar logado
     */
    public function editRecord(Request $request,int $id): JsonResponse{
        $bank_accounts =  Bank_Account::where('id','=',$id)->update([
            'user_id' => $request->user_id,
            'account_number' => $request->account_number,
            'account_digit' => $request->account_digit,
            'account_holder_name' => $request->account_holder_name,
            'branch_code' => $request->branch_code,
            'bank_code' => $request->bank_code
            ]);
        return response()->json(['message'=>'atualizado', 'request' => $request]);
    }

    /**
     * Apagar Conta
     *
     * Endpoint para apagar conta bancária para o usuário. Precisa estar logado
     */
    public function deleteRecord(int $user_id): JsonResponse{
        $bank_accounts =  Bank_Account::where('user_id', '=', $user_id )->delete();
        return response()->json(['message'=>'Deletado']);
    }
}
