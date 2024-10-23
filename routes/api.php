<?php

use App\Http\Controllers\jogoController;
use App\Http\Controllers\ModalidadesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ApostasController;
use App\Http\Controllers\TimeController;

// Rotas de autenticação
Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'App\Http\Controllers'
    ],
    function () {
        Route::get('me', 'AuthController@me');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('register', 'AuthController@register');
        Route::patch('promote/{user}', 'AuthController@promote')->middleware('isAdmin');
    }
);

// Rotas de dados bancários autenticadas
Route::prefix("/bank-account")->middleware('logged')->group(function () {
    Route::get('/get/{id}', [BankAccountController::class, 'Account_of_User']);
    Route::post('/post', [BankAccountController::class, 'createRecord']);
    Route::put('/edit/{id}', [BankAccountController::class, 'editRecord']);
    Route::delete('/delete/{id}', [BankAccountController::class, 'deleteRecord']);

});

// Rotas de jogos para usuários admin
Route::prefix("/jogos")->middleware('isAdmin')->group(function () {
    Route::get('/', [jogoController::class, 'getAllRecord']);
    Route::post('/inserir', [jogoController::class, 'createRecord']);
    Route::put('/editar/{id}', [jogoController::class, 'editRecord']);
    Route::delete('/deletar/{id}', [jogoController::class, 'deleteRecord']);
    Route::get('/passados', [jogoController::class, 'listarJogosQuePassaram']);
    Route::put('/finalizar/{id}', [jogoController::class, 'realizarJogo']);
});

// Rotas de jogos para usuários logados
Route::prefix("/jogos")->middleware('logged')->group(function () {
    Route::get('/futuros', [jogoController::class, 'listarJogosQueAindaNaoComecaram']);
    Route::get('/{id}', [jogoController::class, 'verResultadoDeJogo']);
});

// Rotas de times para usuários admin
Route::prefix("/time")->middleware('isAdmin')->group(function () {
    Route::get('/', [TimeController::class, 'getAllRecord']);
    Route::get('/{id}', [TimeController::class, 'getRecord']);
    Route::post('/inserir', [TimeController::class, 'createRecord']);
    Route::put('/editar/{id}', [TimeController::class, 'editRecord']);
    Route::delete('/deletar/{id}', [TimeController::class, 'deleteRecord']);
});

// Rotas para as apostas para usuários admin
Route::prefix("/apostas")->middleware('isAdmin')->group(function () {
    Route::get('/', [ApostasController::class, 'index']);
    Route::get('/vencedor/{venceu}', [ApostasController::class, 'showVencedor']);
    Route::get('/placar/{placarCasa}/{placarVisitante}', [ApostasController::class, 'showPlacar']);
    Route::patch('/venceu/{id}', [ApostasController::class, 'updateVenceu']); // Nova rota para atualizar 'venceu'
});

Route::prefix("/apostas")->middleware('logged')->group( function() {
    Route::post('/', [ApostasController::class, 'store']);
    Route::get('/minhas', [ApostasController::class, 'ver_minhas_apostas']);
});


//Rotas para modalidade, para usuários logados e Admin
Route::prefix('/modalidade')->middleware('logged')->group(function () {
    Route::get('/', [ModalidadesController::class, 'index']);
    Route::get('/{modalidades}', [ModalidadesController::class, 'show']);
});
Route::prefix('/modalidade')->middleware('isAdmin')->group(function () {
    Route::post('/', [ModalidadesController::class, 'store']);
    Route::patch('/{modalidades}', [ModalidadesController::class, 'update']);
    Route::delete('/{modalidades}', [ModalidadesController::class, 'destroy']);
});
