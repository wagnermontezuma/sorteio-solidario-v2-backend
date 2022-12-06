<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::group([
    'prefix' => 'controle/',
    'middleware' => ['web', 'auth:sanctum', 'verified'],
    'as' => 'controle.',
], function () {
    Route::get('controle/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
