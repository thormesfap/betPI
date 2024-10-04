<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'App\Http\Controllers'
    ],
    function ($router) {
        Route::get('me', 'AuthController@me');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('register', 'AuthController@register');
        Route::patch('promote/{user}', 'AuthController@promote')->middleware('isAdmin');
    }
);
Route::prefix("/bank-account")->middleware('logged')->group(function () {
    Route::get('/get/{id}', [BankAccountController::class, 'Account_of_User']);
    Route::post('/post', [BankAccountController::class, 'createRecord']);
    Route::put('/edit/{id}', [BankAccountController::class, 'editRecord']);
    Route::delete('/delete/{id}', [BankAccountController::class, 'deleteRecord']);
});
