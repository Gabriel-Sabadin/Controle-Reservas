<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;


Route::middleware([CheckIsNotLogged::class])->group(function(){
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
    Route::get('/cadastro', [AuthController::class, 'cadastro'])->name('cadastro');
    Route::post('/cadastroSubmit', [AuthController::class, 'cadastroSubmit'])->name('cadastroSubmit');
    
});


Route::middleware([CheckIsLogged::class])->group(function(){
    Route::get('/dados', [AuthController::class, 'dados'])->name('dados');
    Route::put('/dados', [AuthController::class, 'dadosSubmit'])->name('dadosSubmit');
    Route::get('/calendario', [MainController::class, 'index'])->name('calendario');
    Route::get('/todas-reservas', [MainController::class, 'todas'])->name('todas');
    Route::get('/minhas-reservas', [MainController::class, 'minhas'])->name('minhas');
    Route::get('/adicionar-reserva', [MainController::class, 'adicionarReserva'])->name('adicionarReserva');
    Route::post('/adicionar-reserva', [MainController::class, 'adicionarBanco'])->name('adicionarBanco');
    Route::put('/editar-reserva', [MainController::class, 'editarSubmit'])->name('editarSubmit');
    Route::get('/editar-reserva', [MainController::class, 'editar'])->name('editar');
    Route::delete('/apagar-reserva/{id}', [MainController::class, 'apagarSubmit'])->name('apagarSubmit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::redirect('/', '/calendario');