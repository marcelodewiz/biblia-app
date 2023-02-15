<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Livro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Livro::create($request->all())){
            return response()->json([
                'message'=>'Livro Cadastrado com sucesso'
            ], 201);
        }
        return response()->json([
            'message' =>'Erro ao cadastrar o livro.'
        ], 404);
    }

    public function show($livro)
    {
        $livro = Livro::find($livro);
        if($livro){
            $livro->testamento;
            $livro->versiculos;
            return $livro;
        }

        return response()->json([
            'message' =>'Erro ao pesquisar o livro.'
        ], 404);
    }

    public function update(Request $request, $livro)
    {
        $livro = Livro::find($livro);
        if($livro){
            $livro->update($request->all());
            return $livro;
        }

        return response()->json([
            'message' =>'Erro ao atualizar o livro.'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($livro)
    {
        $livro = Livro::find($livro);
        if($livro){
            return Livro::destroy($livro);
        }

        return response()->json([
            'message' =>'Erro ao excluir o livro.'
        ], 404);
    }
}
