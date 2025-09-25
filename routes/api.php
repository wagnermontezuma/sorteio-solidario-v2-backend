<?php

use App\Http\Controllers\PagSeguroController;
use App\Http\Controllers\RaffleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas em português consumidas pelo frontend público
Route::get('/sorteios', [RaffleController::class, 'index']);
Route::get('/sorteio/{raffle}', [RaffleController::class, 'show']);
Route::post('/sorteio/{raffle}/comprar', [RaffleController::class, 'purchase']);
Route::post('/webhooks/pagseguro', [PagSeguroController::class, 'callback'])->name('pagseguro.webhook');

// Rotas antigas mantidas para compatibilidade temporária
Route::get('/raffles', [RaffleController::class, 'index']);
Route::get('/raffles/{raffle}', [RaffleController::class, 'show']);
Route::post('/raffles/{raffle}/purchase', [RaffleController::class, 'purchase']);
