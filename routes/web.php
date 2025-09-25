<?php

use App\Http\Controllers\Admin\RaffleAdminController;
use App\Http\Controllers\PagSeguroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('controle.dashboard');
})->name('home');

Route::group([
    'prefix' => 'controle',
    'middleware' => ['web', 'auth:sanctum', 'verified'],
    'as' => 'controle.',
], function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('sorteios', RaffleAdminController::class)->except(['show']);

    /*--------------------------------------------------------------------------
    | Rotas do controle (Exemplo)
    |--------------------------------------------------------------------------*/
    // Route::controller(CategoriaController::class)->prefix('categoria')->name('categoria.')->group(function () {
    //     Route::get('/', 'index')->middleware('permission:Visualizar categoria')->name('index');
    //     Route::get('/form/{id?}', 'form')->middleware('permission:Cadastrar categoria')->name('form');
    //     Route::post('/store', 'store')->middleware('permission:Cadastrar categoria')->name('store');
    //     Route::post('/update/{id}', 'update')->middleware('permission:Alterar categoria')->name('update');
    //     Route::get('/delete/{id}', 'delete')->middleware('permission:Excluir categoria')->name('delete');
    // });
});

Route::post('/pagseguro/callback', [PagSeguroController::class, 'callback'])->name('pagseguro.callback');
Route::get('/pagseguro/sucesso', [PagSeguroController::class, 'success'])->name('pagseguro.success');
