<?php

namespace App\Http\Controllers;

use App\Models\Testamento;
use Illuminate\Http\Request;

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
            ], 201);
        }
        return response()->json([
            'message' =>'Erro ao cadastrar o testamento.'
        ], 404);
    }

    public function show($testamento)
    {
        $testamento = Testamento::findOrFail($testamento);
        if($testamento){
            $testamento->livros;

            return $testamento;
        }

        return response()->json([
            'message' =>'Erro ao pesquisar o testamento.'
        ], 404);
    }

    public function update(Request $request, $testamento)
    {
        $testamento = Testamento::findOrFail($testamento);
        if($testamento){
            $testamento->update($request->all());
            return $testamento;
        }

        return response()->json([
            'message' =>'Erro ao atualizar o testamento.'
        ], 404);
    }

    public function destroy($testamento)
    {
        $testamento = Testamento::find($testamento);
        if($testamento){
            return Testamento::destroy($testamento);
        }

        return response()->json([
            'message' =>'Erro ao excluir o testamento.'
        ], 404);
    }
}
