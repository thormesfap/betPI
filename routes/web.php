<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version(), 'Name' => config('app.name')];
});




require __DIR__.'/auth.php';
