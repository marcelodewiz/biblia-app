<?php

use App\Http\Controllers\TestamentoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\VersiculoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*Route::get('/teste', function () {
    return "teste com sucesso";
});

Route::get('/testamento', [TestamentoController::class, 'index']);
Route::get('/testamento/{id}', [TestamentoController::class, 'show']);
Route::put('/testamento/{id}', [TestamentoController::class, 'update']);
Route::delete('/testamento/{id}', [TestamentoController::class, 'destroy']);
Route::post('/testamento', [TestamentoController::class, 'store']);

Route::get('/livro', [LivroController::class, 'index']);
Route::get('/livro/{id}', [LivroController::class, 'show']);
Route::put('/livro/{id}', [LivroController::class, 'update']);
Route::delete('/livro/{id}', [LivroController::class, 'destroy']);
Route::post('/livro', [LivroController::class, 'store']);

Route::get('/versiculo', [VersiculoController::class, 'index']);
Route::get('/versiculo/{id}', [VersiculoController::class, 'show']);
Route::put('/versiculo/{id}', [VersiculoController::class, 'update']);
Route::delete('/versiculo/{id}', [VersiculoController::class, 'destroy']);
Route::post('/versiculo', [VersiculoController::class, 'store']);*/

/*Route::apiResource('versiculo', VersiculoController::class);
Route::apiResource('livro', LivroController::class);
Route::apiResource('testamento', TestamentoController::class);*/

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::apiResources([
        'testamento' => TestamentoController::class,
        'livro' => LivroController::class,
        'versiculo' =>VersiculoController::class
    ]);
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
