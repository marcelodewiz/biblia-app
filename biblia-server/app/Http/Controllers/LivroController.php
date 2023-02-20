<?php

namespace App\Http\Controllers;

use App\Http\Resources\LivroResource;
use App\Http\Resources\LivrosCollection;
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
        return new LivrosCollection(Livro::select('nome', 'abreviacao')->paginate(5));
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
        $livroFounded = Livro::with('testamento','verisculos')->find($livro);
        if($livroFounded){
            return new LivroResource($livroFounded);
        }

        return response()->json([
            'message' =>'Erro ao pesquisar o livro.'
        ], 404);
    }

    public function update(Request $request, $livro)
    {
        $livroFounded = Livro::find($livro);
        if($livroFounded){
            $livroFounded->update($request->all());
            return new LivroResource($livroFounded);
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
