<?php

use App\Http\Controllers\jogoController;
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
Route::prefix("/games")->middleware('isAdmin')->group(function () {
    Route::get('/getAll', [jogoController::class, 'getAllRecord']);
    Route::post('/post', [jogoController::class, 'createRecord']);
    Route::put('/edit/{id}', [jogoController::class, 'editRecord']);
    Route::delete('/delete/{id}', [jogoController::class, 'deleteRecord']);
    Route::put('/realizarJogo/{id}', [jogoController::class, 'realizarJogo']);
});

// Rotas de jogos para usuários logados
Route::prefix("/games")->middleware('logged')->group(function () {
    Route::get('/futuros', [jogoController::class, 'listarJogosQueAindaNaoComecaram']);
    Route::get('/verJogo/{id}', [jogoController::class, 'verResultadoDeJogo']);
});

// Rotas de times para usuários admin
Route::prefix("/time")->middleware('isAdmin')->group(function () {
    Route::get('/getAll', [TimeController::class, 'getAllRecord']);
    Route::get('/get/{id}', [TimeController::class, 'getRecord']);
    Route::post('/post', [TimeController::class, 'createRecord']);
    Route::put('/edit/{id}', [TimeController::class, 'editRecord']);
    Route::delete('/delete/{id}', [TimeController::class, 'deleteRecord']);
});

// Rotas para as apostas para usuários admin
Route::prefix("/apostas")->middleware('isAdmin')->group(function () {
    Route::post('/', [ApostasController::class, 'store']);
    Route::get('/', [ApostasController::class, 'index']);
    Route::get('/vencedor/{venceu}', [ApostasController::class, 'showVencedor']);
    Route::get('/placar/{placarCasa}/{placarVisitante}', [ApostasController::class, 'showPlacar']);
    Route::patch('/venceu/{id}', [ApostasController::class, 'updateVenceu']); // Nova rota para atualizar 'venceu'
});

Route::prefix("/apostas")->middleware('logged')->group( function() {
    Route::post('/', [ApostasController::class, 'store']);
    Route::post('/minhas', [ApostasController::class, 'showUserApostas']);
});