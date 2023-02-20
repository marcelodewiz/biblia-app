<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestamentoResource;
use App\Models\Testamento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestamentoController extends Controller
{
    public function index()
    {
        return Testamento::all();
    }

    public function store(Request $request)
    {
        if(Testamento::create($request->all())){
            return response()->json([
                'message'=>'Testamento Cadastrado com sucesso'
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'message' =>'Erro ao cadastrar o testamento.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function show($testamento)
    {
        $testamentoFounded = Testamento::with('livros')->find($testamento);
        if($testamentoFounded){

            return new TestamentoResource($testamentoFounded);
        }

        return response()->json([
            'message' =>'Erro ao pesquisar o testamento.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function update(Request $request, $testamento)
    {
        $testamentoFounded = Testamento::find($testamento);
        if($testamentoFounded){
            $testamentoFounded->update($request->all());
            return new TestamentoResource($testamentoFounded);
        }

        return response()->json([
            'message' =>'Erro ao atualizar o testamento.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function destroy($testamento)
    {
        $testamentoFounded = Testamento::find($testamento);
        if($testamentoFounded){
            return Testamento::destroy($testamentoFounded);
        }

        return response()->json([
            'message' =>'Erro ao excluir o testamento.'
        ], Response::HTTP_NOT_FOUND);
    }
}
