<?php

use App\Http\Controllers\TestamentoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\VersiculoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\VersaoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::apiResources([
        'testamento' => TestamentoController::class,
        'livro' => LivroController::class,
        'versiculo' => VersiculoController::class,
        'idioma' => IdiomaController::class,
        'versao' => VersaoController::class
    ]);
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

//publico
Route::get('/site', [\App\Http\Controllers\SiteController::class, 'index'])->name('site.index');
