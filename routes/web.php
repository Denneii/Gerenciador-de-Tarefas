<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::group(['prefix' => 'tarefas'], function() {
    Route::get('/', [TarefaController::class, 'index'])->name('tarefas.index');
    Route::post('/', [TarefaController::class, 'store'])->name('tarefas.store');

    Route::group(['prefix' => '{id}'], function() {
        Route::get('/', [TarefaController::class, 'find'])->name('tarefas.edit');
        Route::put('/', [TarefaController::class, 'update'])->name('tarefas.update');
        Route::delete('/', [TarefaController::class, 'delete'])->name('tarefas.destroy');
    });
});
