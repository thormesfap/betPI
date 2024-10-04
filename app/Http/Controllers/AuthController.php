<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     *
     * Registrar Usuário
     *
     * Registra um novo usuário no sistema
     */
    public function register(UserRequest $request): JsonResponse{

        $data = $request->all();
        $existing = User::where('email', $data['email'])->get();
        if($existing->count() > 0){
            return response()->json(['success' => false,'message' => 'Usuário já existe'], 400);
        }
        $user = User::create($data);
        $user->save();
        return response()->json(new UserResource($user));
    }

    /**
     *
     * Login
     *
     * Realiza o login de um usuário cadastrado no sistema
     */

    public function login(Request $request): JsonResponse{
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();
        return $this->respondWithToken($token, $user);
    }

    /**
     *
     * Informações do Usuário
     *
     * Traz informações sobre qual o usuário que está logado no sistema
     *
     */

    public function me(): JsonResponse
    {
        $user = auth('api')->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return response()->json(new UserResource(auth('api')->user()));
    }

    /**
     *
     * Logout
     *
     * Realiza o logout do usuário logado
     */

    public function logout(): JsonResponse
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     *
     * Atualiza Token
     *
     * Faz a atualização do token do usuário, caso ainda não esteja vencido
     */

    public function refresh(): JsonResponse{
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function promote(User $user): JsonResponse
    {
        $roleAdmin = Role::where('name', 'role_admin')->first();
        if((in_array('role_admin',$user->getRoleNamesAttribute())))
        {
            return response()->json(['message' => 'Usuário já é administrador'], Response::HTTP_BAD_REQUEST);
        }
        $user->roles()->attach($roleAdmin->id);
        $user->save();
        $user->refresh();
        return response()->json(new UserResource($user));
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

}
