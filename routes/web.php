<?php

use App\Http\Controllers\Admin\SorteioAdminController;
use App\Http\Controllers\PagSeguroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/sorteios', [SorteioAdminController::class, 'index'])->name('sorteios.index');
    Route::get('/sorteios/criar', [SorteioAdminController::class, 'create'])->name('sorteios.create');
    Route::post('/sorteios', [SorteioAdminController::class, 'store'])->name('sorteios.store');

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

Route::group([
    'prefix' => 'controle',
    'middleware' => ['web', 'auth:sanctum', 'verified'],
], function () {
    Route::get('/{any?}', function () {
        return redirect('/admin');
    })->where('any', '.*');
});

Route::get('/pagseguro/sucesso', [PagSeguroController::class, 'success'])->name('pagseguro.success');
