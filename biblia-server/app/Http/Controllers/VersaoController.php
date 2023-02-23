<?php

namespace App\Http\Controllers;

use App\Http\Resources\VersaoResource;
use App\Models\Versao;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VersaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Versao::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Versao::create($request->all())) {
            return response()->json([
                'message' => 'Versão cadastrada com sucesso,'
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'Erro ao cadastrar a Versão'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($versao)
    {
        $versao = Versao::with('idioma', 'livros')->find($versao);
        if ($versao) {
            return new VersaoResource($versao);
        }

        return response()->json([
            'message' => 'Erro ao pesquisar a versão'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $versao)
    {
        $versao = Versao::find($versao);
        if ($versao) {
            $versao->update($request->all());

            return $versao;
        }

        return response()->json([
            'message' => 'Erro ao atualizar a Versão'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($versao)
    {
        if (Versao::destroy($versao)) {
            return response()->json([
                'message' => ' Versao deletada com sucesso.'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => ' Erro ao deletar a versão.'
        ], Response::HTTP_NOT_FOUND);
    }
}
