<?php

use Illuminate\Support\Facades\Route;

Route::controller('TestsApi\TaskManager_1')
    ->prefix('v1')
    ->group(function () {
        Route::get('/tarefas', 'index');
        Route::get('/tarefas/{id}', 'show');
        Route::post('/tarefas', 'store');
        Route::put('/tarefas/{id}', 'update');
        Route::delete('/tarefas/{id}', 'destroy');
    }
);